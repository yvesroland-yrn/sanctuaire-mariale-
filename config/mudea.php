<?php

return [
    'brand' => [
        'name' => 'Sanctuaire',
        'logo' => 'images/logo.png',
        'full_name' => "SANCTUAIRE NOTRE DAME DE SASSAKO",
        'tagline' => "Lieu de Prière et de Grâce",
        'location' => "Sassako, Mali",
    ],
    'stats' => [
        ['value' => '1500+', 'label' => 'pèlerins annuels'],
        ['value' => '50+', 'label' => 'célébrations par an'],
        ['value' => '12', 'label' => 'projets d\'aide'],
        ['value' => '200+', 'label' => 'donateurs actifs'],
    ],
    'navigation' => [
        ['label' => 'Accueil', 'route' => 'home'],
        ['label' => 'À Propos', 'route' => 'propos'],
        ['label' => 'Projets', 'route' => 'projets'],
        ['label' => 'Actualités', 'route' => 'actualites'],
        ['label' => 'Conseils', 'route' => 'conseils'],
        ['label' => 'Contact', 'route' => 'contact'],
    ],
    'footer' => [
        'about' => [
            'title' => 'SANCTUAIRE',
            'subtitle' => "Notre Dame de Sassako",
            'lines' => [
                'Lieu de prière et de spiritualité',
                'Dédié à la Mère de Dieu',
            ],
        ],
        'contact' => [
            'phone' => '+223 XX XX XX XX',
            'email' => 'contact@sanctuaire-sassako.org',
            'location' => "Sassako, Mali",
        ],
        'links' => [
            ['label' => 'Accueil', 'route' => 'home'],
            ['label' => 'Projets', 'route' => 'projets'],
            ['label' => 'Actualités', 'route' => 'actualites'],
            ['label' => 'Contact', 'route' => 'contact'],
        ],
        'bottom' => [
            'copyright' => '© 2026 Sanctuaire Notre Dame de Sassako. Tous droits réservés.',
            'legal' => 'Mentions légales',
            'privacy' => 'Politique de confidentialité',
        ],
    ],
    'pages' => [
        'home' => [
            'title' => 'Sanctuaire Notre Dame de Sassako',
            'eyebrow' => 'Bienvenue',
            'subtitle' => "Lieu de Prière et de Grâce",
            'slogan' => 'Dans la foi et la compassion, nous servons',
            'intro' => 'Le Sanctuaire Notre Dame de Sassako est un lieu de prière, de recueillement et de partage de la foi. Découvrez nos actualités, projets et conseils spirituels.',
            'image' => 'sanctuaire.jpg',
            'mission_line' => 'Être un phare de spiritualité et d\'aide au service de la communauté.',
            'hero_points' => [
                'Spiritualité et prière',
                'Projets d\'aide communautaire',
                'Conseils spirituels',
            ],
            'reasons' => [
                [
                    'title' => 'Prier',
                    'text' => 'Un espace de recueillement dédié à la Mère de Dieu et à la prière communautaire.',
                ],
                [
                    'title' => 'Servir',
                    'text' => 'Mettre en avant les projets d\'aide et de solidarité envers la communauté.',
                ],
                [
                    'title' => 'Guider',
                    'text' => 'Partager les conseils spirituels et les enseignements de la foi.',
                ],
            ],
            'project_cards' => [
                [
                    'title' => 'À Propos',
                    'text' => 'Histoire, mission et vision du Sanctuaire Notre Dame de Sassako.',
                    'route' => 'propos',
                    'button' => 'En savoir plus',
                    'image' => 'church.jpg',
                ],
                [
                    'title' => 'Projets',
                    'text' => 'Les projets d\'aide et de développement communautaire en cours.',
                    'route' => 'projets',
                    'button' => 'Voir les projets',
                    'image' => 'projects.jpg',
                ],
                [
                    'title' => 'Actualités',
                    'text' => 'Les dernières informations et célébrations du Sanctuaire.',
                    'route' => 'actualites',
                    'button' => 'Lire les actualités',
                    'image' => 'news.jpg',
                ],
            ],
            'sections' => [
                [
                    'title' => 'Accès simple',
                    'text' => 'Un site clair et accessible pour tous les fidèles et visiteurs.',
                ],
                [
                    'title' => 'Informations à jour',
                    'text' => 'Actualités, calendrier des célébrations et annonces du Sanctuaire.',
                ],
                [
                    'title' => 'Engagement communautaire',
                    'text' => 'Projets de solidarité et d\'aide sociale au service du quartier.',
                ],
            ],
        ],
        'propos' => [
            'title' => 'À Propos',
            'eyebrow' => 'Notre Histoire',
            'intro' => "Histoire, mission, vision et organisation du Sanctuaire Notre Dame de Sassako.",
            'image' => 'church.jpg',
            'highlights' => [
                'Notre histoire',
                'Notre mission',
                'Notre vision',
                'Organisation',
                'Contacts',
            ],
            'sections' => [
                ['title' => 'Racines', 'text' => 'Présenter les origines et l\'évolution du Sanctuaire.'],
                ['title' => 'Objectifs', 'text' => 'Afficher clairement la mission et les buts du Sanctuaire.'],
                ['title' => 'Structure', 'text' => 'Montrer l\'organisation et les responsables.'],
            ],
        ],
        'projets' => [
            'title' => 'Projets',
            'eyebrow' => 'Aide Communautaire',
            'intro' => 'Projets en cours, réalisés et à venir pour le développement social et spirituel.',
            'image' => 'projects.jpg',
            'highlights' => [
                'Projets en cours',
                'Projets réalisés',
                'Projets futurs',
                'État d\'avancement',
                'Partenaires',
            ],
            'sections' => [
                ['title' => 'Clarté', 'text' => 'Chaque projet est simple à lire et à suivre dans ses étapes.'],
                ['title' => 'Suivi', 'text' => 'L\'état d\'avancement rend le suivi transparent et concret.'],
                ['title' => 'Contribution', 'text' => 'Les visiteurs comprennent comment soutenir nos actions.'],
            ],
        ],
        'actualites' => [
            'title' => 'Actualités',
            'eyebrow' => 'Informations',
            'intro' => 'Dernières nouvelles, calendrier, célébrations et annonces du Sanctuaire.',
            'image' => 'news.jpg',
            'highlights' => [
                'Articles',
                'Calendrier',
                'Célébrations',
                'Annonces importantes',
            ],
            'sections' => [
                ['title' => 'Vivacité', 'text' => 'Un flux vivant montrant l\'activité du Sanctuaire.'],
                ['title' => 'Lecture rapide', 'text' => 'Des articles simples et bien structurés pour la consultation.'],
                ['title' => 'Informations essentielles', 'text' => 'Les dates et événements importants en évidence.'],
            ],
        ],
        'conseils' => [
            'title' => 'Conseils Spirituels',
            'eyebrow' => 'Spiritualité',
            'intro' => 'Réflexions, enseignements et conseils spirituels pour la vie de foi.',
            'image' => 'spiritual.jpg',
            'highlights' => [
                'Réflexions',
                'Enseignements',
                'Méditations',
                'Prières',
            ],
            'sections' => [
                ['title' => 'Guidance', 'text' => 'Des conseils pour approfondir la vie spirituelle.'],
                ['title' => 'Partage', 'text' => 'Réflexions et méditations pour l\'édification.'],
                ['title' => 'Accessibilité', 'text' => 'Contenu adapté à tous les niveaux de compréhension.'],
            ],
        ],
        'contact' => [
            'title' => 'Contact',
            'eyebrow' => 'Nous Joindre',
            'intro' => 'Coordonnées, formulaire et localisation du Sanctuaire Notre Dame de Sassako.',
            'image' => 'location.jpg',
            'highlights' => [
                'Téléphone et email',
                'Formulaire de contact',
                'Localisation',
                'Horaires',
            ],
            'sections' => [
                ['title' => 'Accessibilité', 'text' => 'Facile de nous trouver et de nous contacter.'],
                ['title' => 'Clarté', 'text' => 'Les différents canaux de communication sont explicites.'],
                ['title' => 'Réactivité', 'text' => 'Nous répondons rapidement aux demandes.'],
            ],
        ],
    ],
];
