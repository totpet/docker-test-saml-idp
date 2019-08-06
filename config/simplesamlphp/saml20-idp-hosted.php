<?php
/**
 * SAML 2.0 IdP configuration for SimpleSAMLphp.
 *
 * See: https://simplesamlphp.org/docs/stable/simplesamlphp-reference-idp-hosted
 */

$metadata['__DYNAMIC:1__'] = [
    /*
     * The hostname of the server (VHOST) that will use this SAML entity.
     *
     * Can be '__DEFAULT__', to use this entry by default.
     */
    'host' => '__DEFAULT__',

    // X.509 key and certificate. Relative to the cert directory.
    'privatekey' => 'server.pem',
    'certificate' => 'server.crt',

    /*
     * Authentication source to use. Must be one that is configured in
     * 'config/authsources.php'.
     */
    'auth' => 'example-userpass',

    /* Uncomment the following to use the uri NameFormat on attributes. */
    'attributes.NameFormat' => 'urn:oasis:names:tc:SAML:2.0:attrname-format:uri',

    'userid.attribute' => 'uid',
    'scope' => [ getenv('VIRTUAL_HOST') ],

    'authproc' => [
        /* Enable the authproc filter below to add URN Prefixces to all attributes
         10 => array(
             'class' => 'core:AttributeMap', 'addurnprefix'
         ), */
        /* Enable the authproc filter below to automatically generated eduPersonTargetedID.
        20 => 'core:TargetedID',
        */
        20 => 'core:TargetedID',

        // Adopts language from attribute to use in UI
        30 => 'core:LanguageAdaptor',

        /* Add a realm attribute from edupersonprincipalname
        40 => 'core:AttributeRealm',
         */
        45 => [
            'class'         => 'core:StatisticsWithAttribute',
            'attributename' => 'realm',
            'type'          => 'saml20-idp-SSO',
        ],

        49 => [
            'class' => 'core:AttributeMap', 'name2oid'
        ],
        /* When called without parameters, it will fallback to filter attributes ‹the old way›
         * by checking the 'attributes' parameter in metadata on IdP hosted and SP remote.
         */
        50 => 'core:AttributeLimit',

        /*
         * Search attribute "distinguishedName" for pattern and replaces if found
        60 => [
            'class' => 'core:AttributeAlter',
            'pattern' => '/OU=studerende/',
            'replacement' => 'Student',
            'subject' => 'distinguishedName',
            '%replace',
        ],
         */

        /*
         * Consent module is enabled (with no permanent storage, using cookies).
        90 => [
            'class' => 'consent:Consent',
            'store' => 'consent:Cookie',
            'focus' => 'yes',
            'checked' => TRUE
        ],
         */
    ],

    /*
     * Uncomment the following to specify the registration information in the
     * exported metadata. Refer to:
     * http://docs.oasis-open.org/security/saml/Post2.0/saml-metadata-rpi/v1.0/cs01/saml-metadata-rpi-v1.0-cs01.html
     * for more information.
     */
    /*
    'RegistrationInfo' => [
        'authority' => 'urn:mace:example.org',
        'instant' => '2008-01-17T11:28:03Z',
        'policies' => [
            'en' => 'http://example.org/policy',
            'es' => 'http://example.org/politica',
        ],
    ],
    */
];
