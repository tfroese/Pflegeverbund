<?php

function sendLeadImportRequest($lead_checked, $interface_password, $interface_brokercode, $lead_art, $lead_lastname, $lead_name, $lead_zip, $lead_location, $lead_email, $lead_phone_private, $lead_ref, $lead_target, $lead_carelevel, $lead_start_time) {
    $requestXML = '<?xml version="1.0" encoding="iso-8859-1"?>
    <methodCall>
        <methodName>Lead.Import</methodName>
        <params>
            <param>
                <value>
                    <struct>
                        <member>
                            <name>Geprueft</name>
                            <value>
                                <string>' . $lead_checked . '</string>
                            </value>
                        </member>
                        <member>
                            <name>InterfacePassword</name>
                            <value>
                                <string>' . $interface_password . '</string>
                            </value>
                        </member>
                        <member>
                            <name>BrokerCode</name>
                            <value>
                                <string>' . $interface_brokercode . '</string>
                            </value>
                        </member>
       
                        <member>
                            <name>Art</name>
                            <value>
                                <string>' . $lead_art . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Name</name>
                            <value>
                                <string>' . $lead_lastname . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Vorname</name>
                            <value>
                                <string>' . $lead_name . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Strasse</name>
                            <value>
                                <string>X</string>
                            </value>
                        </member>
                        <member>
                            <name>PLZ</name>
                            <value>
                                <string>' . $lead_zip . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Ort</name>
                            <value>
                                <string>' . $lead_location . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Email</name>
                            <value>
                                <string>' . $lead_email . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Geburtstag</name>
                            <value>
                                <string>01.01.1900</string>
                            </value>
                        </member>
                        <member>
                            <name>Berufsstatus</name>
                            <value>
                                <string>X</string>
                            </value>
                        </member>
                        <member>
                            <name>Tel_privat</name>
                            <value>
                                <string>' . $lead_phone_private . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Herkunft</name>
                            <value>
                                <string>' . $lead_ref . '</string>
                            </value>
                        </member>
                        <member>
                            <name>lead_target</name>
                            <value>
                                <string>' . $lead_target . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Pflegegrad</name>
                            <value>
                                <string>' . $lead_carelevel . '</string>
                            </value>
                        </member>
                        <member>
                            <name>Start der Unterstützung</name>
                            <value>
                                <string>' . $lead_start_time . '</string>
                            </value>
                        </member>

                    </struct>
                </value>
            </param>
        </params>
    </methodCall>';

    echo $requestXML;

    $requestXML = utf8_decode($requestXML);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://lhp.pivacom.com/interface/XMLRPC_Broker.php');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:text/xml'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);

    $Result = curl_exec($ch);

    if ($nr = curl_errno($ch)) {
        curl_error($ch);
    }

    echo "<pre>";
    print_r($Result);
}


?>