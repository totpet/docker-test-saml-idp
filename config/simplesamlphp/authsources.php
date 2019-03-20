<?php

$config = array(

    'admin' => array(
        'core:AdminPassword',
    ),

    'example-userpass' => array(
        'exampleauth:UserPass',
        'user1:user1pass' => array(
            'uid' => array('1'),
            'eduPersonAffiliation' => array('group1'),
            'email' => 'user1@'.getenv('VIRTUAL_HOST'),
            'eduPersonPrincipalName' => 'user1@'.getenv('VIRTUAL_HOST'),
        ),
        'user2:user2pass' => array(
            'uid' => array('2'),
            'eduPersonAffiliation' => array('group2'),
            'email' => 'user2@'.getenv('VIRTUAL_HOST'),
            'eduPersonPrincipalName' => 'user2@'.getenv('VIRTUAL_HOST'),
        ),
    ),

);
