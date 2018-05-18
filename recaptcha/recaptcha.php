<?php

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
    //your site secret key
    $secret = '6LfCuFAUAAAAABGHva8Tu006tqdR_OsfuvEBuanS';
    //get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if($responseData->success):
        postZoho($_POST);
    else:
        echo('Robot verification failed, please try again.');
    endif;
else:
    echo('Please click on the reCAPTCHA box.');
endif;

function postZoho($fields) {
    $zohoFormURl = "https://forms.zohopublic.com/zohodocs67/form/BewerbungVPLPTimeWaver/formperma/AbcZgAJ0fhirH6kpDjojQXkUQCZyg3cqTwbfw0MMWBs/htmlRecords/submit";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $zohoFormURl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $response = curl_exec($ch);

    return $response;
}
?>