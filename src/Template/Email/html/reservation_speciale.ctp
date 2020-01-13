<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body>
<style type="text/css">
    <!--
    .clearfix:after {
        content: ".";
        display: block;
        clear: both;
        visibility: hidden;
        line-height: 0;
        height: 0;
    }

    .clearfix {
        display: inline-block;
    }
    .clearfix  {
        display /***/: block9;
    }
    .container {
        width:70%;
        font-family: "Century Gothic", Tahoma, Arial;
    }
    .statusorder {
        width:100%;
        float:none;
        clear:both;
    }
    .boxstatusorder {
        background:#d9f1ff;
        border-radius:4px;
        -moz-border-radius:4px;
        -webkit-border-radius:4px;
        border:1px solid #c4dbdd;
        padding:10px;
        float:left;
        margin:0 5px 10px 0;
        height:25px;
        line-height:25px;
    }
    .boxstatusorder p {
        margin:0;
        padding:0;
    }
    .boxstatusorder:last-child {
        margin:0 0 10px 0;
    }
    .persdetail {
        width:95.8%;
        clear:both;
        float:none;
        padding:10px;
        border:1px solid #eee;
        border-radius:4px;
        -moz-border-radius:4px;
        -webkit-border-radius:4px;
        line-height:1.6em;
    }
    .persdetail h3 {
        margin:0 0 10px 0;
        padding:0;
    }
    .hiremainbox {
        background:#fbfbfb;
        border:1px solid #eee;
        -moz-border:1px solid #eee;
        -webkit-border:1px solid #eee;
        border-radius:4px;
        padding:10px;
        width:95.8%;
        margin:10px 0 0 0;
    }
    .hirecar {
        float:none;
        clear:both;
    }
    .hirecar .hiredate {
        float:left;
        border:1px solid #C9E9FC;
        border-radius:4px;
        -moz-border-radius:4px;
        -webkit-border-radius:4px;
        padding:10px;
        margin:0 10px 0 0;
        background:#f6f6f6;
    }
    .hirecar .hiredate:last-child {
        margin:0;
    }
    .hirecar .hiredate p {
        padding:0;
        margin:0px 0 5px;
    }
    .hirecar .hiredate p span {
        display:block;
    }
    .hireordata {
        margin:0 0 5px 0;
    }
    .hireordata div {
        float:right;
    }
    .hiretotal {
        margin:10px 0 0 0;
        color:#144D5C;
        border-top:1px solid #ddd;
        padding:10px 0 0 0;
    }
    .smalltext {
        font-size:12px;
    }
    .Stile1 {
        font-size: 18px;
        font-weight: bold;
    }
    .Stile2 {
        font-size: 18px;
    }
    .Stile7 {color: #009900;}
    .confirmed {color: #009900;}
    .standby {color: #ff0000;}
    .Stile9 {font-size: 14px; }
    .Stile10 {font-size: 14px;font-weight: bold;}
    .Stile12 {font-size: 14px;font-weight: bold; }
    .Stile16 {font-size: 16px;}
    -->
</style>

<div class="container">
    <p><img height='50%' width='50%' src="http://transports-citadins.jobs-conseil.com/img/logo-ltc.png" alt="Les Transports Citadins"/>
    </p>

    <p class="Stile1">
    </p>
    <div class="persdetail">
        <h3 class="Stile1">Détails du demandeur:</h3>
        Nom & Prénom : <?=$contenu['name']?><br />
        e-mail : <?=$contenu['email']?><br />
        Téléphone : <?=$contenu['telephone']?><br />


    </div>
    <div class="hiremainbox">
        <div class="hirecar clearfix">
            <p><span class="Stile1">Véhicule Souhaité : <?=$contenu['voiture']?>
</span></p>
            <div class="hiredate">
                <p><span class="Stile12">Date de départ:</span>
                    <span class="Stile9"> <?= \App\Controller\AppController::change_format_date($contenu['date_depart']) ?>
</span></p>
                <p><span class="Stile12">Lieu de départ: </span>
                    <span class="Stile9"> <?=$contenu['lieu_depart']?>
</span></p>
            </div>
            <div class="hiredate">
                <p><span class="Stile12">Date de retour: </span>
                    <span class="Stile9"> <?= \App\Controller\AppController::change_format_date($contenu['date_arriver']) ?>
</span></p>
                <p><span class="Stile12">Lieu de retour:</span>
                    <span class="Stile9"> <?=$contenu['lieu_arriver']?>
</span></p>
            </div>
        </div>
        <div class="hireorderdetail">
            <p><span class="Stile1">Description de la réservation:</span></p>
            <div class="hireordata hiretotal"><strong> <?=$contenu['message']?></strong></div>
        </div>
        <br/>
        <p><br/>
            <span class="smalltext">
		<strong>Pour plus d'infos, visitez notre site:</strong><br/>
		<a href="http://www.transports-citadins.com/">Les Transports Citadins</a>
		</span><br/>
        </p>
        <span class="smalltext"></span>
    </div>
</div></body>
</html>