CREATE
OR REPLACE VIEW date_dernier_echeance AS
SELECT
    e.vehicule_id,
    max(e.debut_validite) AS debut_validite,
    e.type_echeance_id
FROM
    echeances e
GROUP BY
    e.type_echeance_id,
    e.vehicule_id;



CREATE
OR REPLACE VIEW echeance_actif AS
SELECT
    dde.vehicule_id,
    e.id,
    dde.type_echeance_id,
    dde.debut_validite,
    e.fin_validite
FROM
    date_dernier_echeance dde
    JOIN echeances e ON dde.vehicule_id = e.vehicule_id
    AND dde.debut_validite = e.debut_validite
    AND dde.type_echeance_id = e.type_echeance_id;



CREATE
OR REPLACE VIEW etat_echeance AS
SELECT
    v.id,
    COALESCE(ev.jour_restant, 0) AS jour_restant
FROM
    vehicules v
    LEFT JOIN echeance_vehicules ev ON v.id = ev.id;



CREATE
OR REPLACE VIEW echeance_non_valide AS
SELECT
    id
FROM
    etat_echeance
WHERE
    jour_restant <= 0;



CREATE
OR REPLACE VIEW echeance_valide AS
SELECT
    DISTINCT id
FROM
    etat_echeance
WHERE
    id NOT IN (
        SELECT
            id
        FROM
            echeance_non_valide
    );



CREATE
OR REPLACE VIEW status_echeance_vehicule AS
SELECT
    v.id,
    v.numero,
    v.modele,
    v.marque,
    te.echeance_nom,
    e.debut_validite,
    e.fin_validite,
    datediff(e.fin_validite, CURRENT_DATE) AS jour_restant
FROM
    echeance_actif e
    JOIN vehicules v ON e.vehicule_id = v.id
    JOIN type_echeances te ON e.type_echeance_id = te.id;



CREATE
OR REPLACE VIEW echeance_vehicules AS
SELECT
    CASE
        WHEN jour_restant <= 15 THEN 'alert-danger'
        WHEN jour_restant <= 30 THEN 'alert-warning'
        ELSE 'alert-secondary'
    END AS color,
    sev.*
FROM
    status_echeance_vehicule sev;



CREATE
OR REPLACE VIEW date_dernier_trajet AS
SELECT
    vehicule_id,
    max(date_arrive) AS date_arrive
FROM
    trajets t
GROUP BY
    vehicule_id;



CREATE
OR REPLACE VIEW dernier_trajet AS
SELECT
    ddt.vehicule_id,
    ddt.date_arrive,
    t.kilometrage_arrive,
    t.lieu_arrive
FROM
    date_dernier_trajet ddt
    JOIN trajets t ON ddt.vehicule_id = t.vehicule_id
    AND ddt.date_arrive = t.date_arrive;



CREATE
OR REPLACE VIEW dernier_trajet_detail AS
SELECT
    ddt.vehicule_id,
    ddt.date_arrive,
    t.kilometrage_arrive,
    t.lieu_arrive,
    l.lieu_nom
FROM
    date_dernier_trajet ddt
    JOIN trajets t ON ddt.vehicule_id = t.vehicule_id
    AND ddt.date_arrive = t.date_arrive
    JOIN lieus l ON t.lieu_arrive = l.id;



CREATE
OR REPLACE VIEW dernier_trajet_vehicule_valide AS
SELECT
    dt.*
FROM
    dernier_trajet dt
    JOIN echeance_valide ev ON dt.vehicule_id = ev.id;



CREATE
OR REPLACE VIEW vehicule_disponibles AS
SELECT
    v.*
FROM
    dernier_trajet_vehicule_valide dt
    JOIN vehicules v ON dt.vehicule_id = v.id
WHERE
    dt.lieu_arrive = 1;



CREATE
OR REPLACE VIEW vehicule_sans_trajet AS
SELECT
    *
FROM
    vehicules
WHERE
    id NOT IN (
        SELECT
            vehicule_id AS id
        FROM
            trajets
    );



CREATE
OR REPLACE VIEW vehicule_trajet_dispo AS
SELECT
    vd.*
FROM
    vehicule_disponibles
    JOIN vehicule_sans_trajet;



CREATE
OR REPLACE VIEW vehicule_disponibles_general AS
SELECT
    *
FROM
    vehicule_dispo 
WHERE
    id IN (
        SELECT
            id
        FROM
            vehicule_disponibles
    ) or id in (select id from vehicule_sans_trajet);



/*Actual*/
CREATE
OR REPLACE VIEW maintenance_vehicules AS
SELECT
    v.vehicule_id,
    coalesce(maintenance_date, CURRENT_DATE) AS maintenance_date,
    v.type_maintenance_id
FROM
    vehicule_type_maintenance v
    LEFT JOIN maintenances m ON v.vehicule_id = m.vehicule_id
    AND v.type_maintenance_id = m.type_maintenance_id;



CREATE
OR REPLACE VIEW date_derniere_maintenance AS
SELECT
    vehicule_id,
    max(maintenance_date) AS maintenance_date,
    type_maintenance_id
FROM
    maintenance_vehicules
GROUP BY
    vehicule_id,
    type_maintenance_id;



CREATE
OR REPLACE VIEW derniere_maintenance AS
SELECT
    ddm.maintenance_date,
    ddm.vehicule_id,
    ddm.type_maintenance_id
FROM
    date_derniere_maintenance ddm
    JOIN maintenance_vehicules m ON ddm.maintenance_date = m.maintenance_date
    AND ddm.vehicule_id = m.vehicule_id
GROUP BY
    m.maintenance_date,
    ddm.type_maintenance_id;



CREATE
OR REPLACE VIEW info_derniere_maintenance AS
SELECT
    maintenance_date,
    nom_maintenance,
    durabilite,
    type_maintenance_id,
    vehicule_id
FROM
    derniere_maintenance dm
    JOIN type_maintenances tm ON dm.type_maintenance_id = tm.id;



CREATE
OR REPLACE VIEW trajet_vehicules AS
SELECT
    coalesce(date_depart, CURRENT_TIMESTAMP) AS date_depart,
    coalesce(date_arrive, CURRENT_TIMESTAMP) AS date_arrive,
    coalesce(kilometrage_arrive, 0) AS kilometrage_arrive,
    coalesce(kilometrage_depart, 0) AS kilometrage_depart,
    v.id AS vehicule_id
FROM
    vehicules v
    LEFT JOIN trajets t ON v.id = t.vehicule_id
    AND date_arrive IS NOT NULL;



CREATE
OR REPLACE VIEW distance_parcourue_par_trajet AS
SELECT
    date_depart,
    (kilometrage_arrive - kilometrage_depart) AS distance_parcourue,
    vehicule_id
FROM
    trajet_vehicules;



CREATE
OR REPLACE VIEW total_parcourue AS
SELECT
    coalesce(sum(distance_parcourue), 0) AS total,
    vehicule_id
FROM
    distance_parcourue_par_trajet
GROUP BY
    vehicule_id;



CREATE
OR REPLACE VIEW total_parcourue_jour AS
SELECT
    coalesce(sum(distance_parcourue), 0) AS total,
    vehicule_id,
    date(date_depart) AS date_depart
FROM
    distance_parcourue_par_trajet
GROUP BY
    vehicule_id,
    date(date_depart);



CREATE
OR REPLACE VIEW etat_maintenance AS
SELECT
    idm.nom_maintenance,
    (idm.durabilite - tp.total) AS km_restant,
    idm.vehicule_id,
    idm.type_maintenance_id
FROM
    info_derniere_maintenance idm
    JOIN total_parcourue tp ON idm.vehicule_id = tp.vehicule_id;



CREATE
OR REPLACE VIEW info_etat_maintenance AS
SELECT
    em.vehicule_id,
    CASE
        WHEN km_restant <= 200 THEN 'alert-danger'
        WHEN km_restant <= 500 THEN 'alert-warning'
        ELSE ''
    END AS color,
    em.nom_maintenance,
    km_restant
FROM
    etat_maintenance em
    JOIN vehicules v ON em.vehicule_id = v.id;



CREATE
OR REPLACE VIEW usure_proche AS
SELECT
    min(km_restant) AS km_restant,
    vehicule_id
FROM
    info_etat_maintenance iem
GROUP BY
    vehicule_id;



CREATE
OR REPLACE VIEW vehicule_type_maintenance AS
SELECT
    v.id AS vehicule_id,
    tm.id AS type_maintenance_id
FROM
    vehicules v
    JOIN type_maintenances tm;



CREATE
OR REPLACE VIEW kilometrage_vehicule_maintenance AS
SELECT
    vtm.vehicule_id,
    coalesce(em.km_restant, 5000) km_restant,
    vtm.type_maintenance_id
FROM
    vehicule_type_maintenance vtm
    LEFT JOIN etat_maintenance em ON vtm.vehicule_id = em.vehicule_id
    AND vtm.type_maintenance_id = em.type_maintenance_id;



CREATE
OR REPLACE VIEW vehicule_en_maintenance AS
SELECT
    vehicule_id
FROM
    kilometrage_vehicule_maintenance
WHERE
    km_restant <= 0;



CREATE
OR REPLACE VIEW vehicule_maintenance_valide AS
SELECT
    vehicule_id
FROM
    kilometrage_vehicule_maintenance
WHERE
    km_restant >= 0;



CREATE
OR REPLACE VIEW vehicule_disponnible_trajet AS
SELECT
    DISTINCT vmv.vehicule_id
FROM
    vehicule_maintenance_valide vmv
    JOIN echeance_valide ev ON vmv.vehicule_id = ev.id;



CREATE
OR REPLACE VIEW detail_usure_proche AS
SELECT
    up.km_restant,
    v.modele,
    v.type_id,
    nom_maintenance,
    v.marque,
    v.numero,
    iem.color
FROM
    usure_proche up
    JOIN info_etat_maintenance iem ON up.vehicule_id = iem.vehicule_id
    AND up.km_restant = iem.km_restant
    JOIN vehicules v ON up.vehicule_id = v.id;



CREATE
OR REPLACE VIEW vehicule_dispo
SELECT
    v.*
FROM
    vehicule_disponnible_trajet vdt
    JOIN vehicules v ON vdt.vehicule_id = v.id;