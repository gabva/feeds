<?php

return [
    'title' => [
        'feeds' => 'Flux RSS',
        'create feed' => 'Créer un flux',
        'edit feed' => 'Editer un flux',
    ],
    'button' => [
        'create feed' => 'Créer un flux',
    ],
    'table' => [
        'name' => 'Nom',
        'status' => 'Statut',
        'actions' => 'Actions'
    ],
    'form' => [

        'name'  => "Nom du flux",
        'url'   => "URL",
        'status' => "Status",
        'comment' => "Commentaire de l'admin"

    ],
    'messages' => [
        'feed created' => 'Flux créé !',
        'feed not found' => 'Flux non trouvé',
        'feed updated' => 'Le flux a été mis à jour',
        'feed deleted' => 'Le flux a été supprimé',
        'feed error' => "L'url du flux semble incorrecte.  Le flux doit être un flux RSS de site/blog valide, ou une page facebook publique (pas de profil, ni groupe) : si il s'agit d'une page et l'adresse est de type http://www.facebook.com/le-nom-123456, alors essayez simplement http/www.facebook.com/123456."



    ],

    'status' => [
        'pending' => "En attente",
        'published' => "Publié",
        'unpublished' => "Suspendu"
    ],
    'validation' => [
        'messages' => [
            'name is required' => "Le nom du flux est obligatoire",
            'url is required' =>  "L'url du flux est obligatoire",
            'url is not valid' => "L'url du flux n'est pas valide",
            'url is not unique' => "Cette url existe déjà"
        ]
    ],
];
