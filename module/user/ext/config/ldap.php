<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Specifies the LDAP or Active Directory server to connect to, and must be
 * provided as an URI
 * - Protocol is optional, can be one of ldap or ldaps, defaults to ldap
 * - Port number is optional, and defaults to 389. If this doesn't work, try
 *   using one of the following standard port numbers: 636 (ldaps); for Active
 *   Directory Global Catalog forest-wide search, use 3268 (ldap) or 3269 (ldaps)
 *
 * Examples of valid URI:
 *
 *   ldap.example.com
 *   ldap.example.com:3268
 *   ldap://ldap.example.com/
 *   ldaps://ldap.example.com:3269/
 *
 */
$config->ldap->ldap_server                      = 'ldap://ldap.example.com:389/';
/**
 * The LDAP Protocol Version, if 0, then the protocol version is not set.  For Active Directory use version 3.
 */
$config->ldap->ldap_protocol_version            = 3;
/**
 * Determines whether the LDAP library automatically follows referrals returned by LDAP servers or not.
 * This maps to LDAP_OPT_REFERRALS ldap library option.  For Active Directory, this should be set to OFF.
 */
$config->ldap->ldap_follow_referrals            = 0;                                    //1 ON, 0 OFF
$config->ldap->ldap_root_dn                     = 'ou=www,dc=abc,dc=com';
$config->ldap->ldap_uid_field                   = 'sAMAccountName';                     // Use 'sAMAccountName' for Active Directory
$config->ldap->ldap_bind_dn                     = 'CN=admin,OU=admin,DC=abc,DC=com';
$config->ldap->ldap_bind_passwd                 = 'abcdef';
/**
* Search filter for acitve person only, !(userAccountControl:1.2.840.113556.1.4.803:=2) means active user in AD
*/
#$config->ldap->ldap_organization               = '(objectCategory=person)(!(userAccountControl:1.2.840.113556.1.4.803:=2))';
