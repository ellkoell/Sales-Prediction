<?php

function ausgabe($tv, $radio, $newspaper) {

// 1. Definiere die API-Endpunkt-URL und die Daten
    $url = 'http://127.0.0.1:5000/predict';

// Die Daten, die als JSON gesendet werden sollen
    $data = array(
        'tv' => $tv,
        'radio' => $radio,
        'newspaper' => $newspaper
    );

// Kodierung der PHP-Daten in das JSON-Format
    $json_data = json_encode($data);

// 2. Initialisiere eine cURL-Sitzung
    $ch = curl_init($url);

// 3. Setze cURL-Optionen
// Setze die Option, um die POST-Methode zu verwenden
    curl_setopt($ch, CURLOPT_POST, 1);

// Füge die JSON-Daten dem POST-Body hinzu
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

// Setze den Header, um den Inhaltstyp als JSON zu kennzeichnen
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Setze die Option, um die Antwort als String zurückzugeben, anstatt sie direkt auszugeben
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 4. Führe die cURL-Anfrage aus und speichere die Antwort
    $response = curl_exec($ch);

// 5. Überprüfe auf cURL-Fehler
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        // Behandle den Fehler (z.B. Loggen oder eine Fehlermeldung ausgeben)
        die("cURL-Fehler: " . $error_msg);
    }

// 6. Schließe die cURL-Sitzung
    curl_close($ch);

// 7. Verarbeite die JSON-Antwort
    $result = json_decode($response, true); // `true` dekodiert in ein assoziatives Array


    //wert zurückgeben
    return isset($result['predicted_sales']) ? $result['predicted_sales'] : null;

}

?>
