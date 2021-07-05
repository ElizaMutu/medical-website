<?php
require_once ("db.php");
session_start();
include 'header.php';  
include 'navbar.php';  
?>

<div class="container-fluid">
    <div class="container">
        <div class="content-left">
            <h2 class="h2forum">Coronavirus în România: Situația actualizată și ultimele știri</h2>

            <p>Pe măsură ce noul coronavirus continuă să se răspândească la nivel mondial cu peste 41 milioane de de
                cazuri confirmate și peste 1,130,000 de decese, România a intensificat eforturile pentru a reduce
                răspândirea infectărilor între granițele sale.</p><br>
            <p>Până în prezent, în România au fost raportate 1078338 cazuri de infectare cu noul coronavirus, fiind
                înregistrate 30499 decese.</p>
            <h5 style="color: #1a8cff;">Ultimele informații privind evoluția infectărilor cu coronavirus</h5><br>
            <p>1. Astăzi au fost raportate 225 noi cazuri, din 21836 teste efectuate. În prezent sunt 341 persoane internate la ATI și au fost raportate 668 cazuri vindecate. 113 de persoane au decedat în ultimele 24 de ore.</p><br>
            <p>2. Evoluția pandemiei în România</p><br>
            <p>Se observă o scadere a cazurilor față de acum 14 zile în Prahova, Galati, Bihor cu 1% respectiv 0% în Bucuresti, Ilfov, Cluj. <br><br>În ceea ce privește cazurile noi, în data de 04.06.2021 în Bucuresti sunt 37 cazuri, urmat de Suceava cu 12 cazuri și Arges cu 10 cazuri. <br><br>Raportat la 1000 de locuitori, totalul cazurilor de la începutul pandemiei avem în Ilfov o rată de incidență de 99.70 urmat de Bucuresti și Cluj cu 85.24 respectiv 77.98.</p>
            <p><a href="/medical/articole/117">3. La cat timp se face rapelul daca ne-am infectat cu COVID-19 intre doze?</a></p>
            <p>In Romania, si nu numai, sunt destul de multe persoane care s-au infectat cu COVID-19 dupa prima doza de vaccin. Ce se intampla cu rapelul, in astfel de situatii?<br>
Valeriu Gheorghita, coordonatorul campaniei nationale de vaccinare, a facut cateva precizari cu privire la intervalul dintre cele doua doze de vaccinare in cazul infectarii cu COVID-19. Acesta sustine ca cei care si-au facut prima doza de vaccin si s-au imbolnavit, intre timp, de COVID-19, si-ar putea face rapelul la doua saptamani de la momentul vindecarii.</p>
            <p><a href="/medical/articole/118">4. STUDIU. Cum interactioneaza COVID-19 cu virusul gripal</a></p>
            <p>Virusul gripal, care provoaca banala raceala, se pare ca are abilitatea de a indeparta SARS-CoV-2, virusul care provoaca boala COVID-19, potrivit unui studiu efectuat de cercetatori de la Universitatea din Glasgow. Concluzia cercetatorilor este ca rinovirusul pacaleste coronavirusului atunci cand se afla in acelasi mediu. Explicatia porneste de la faptul ca unele virusuri „lupta” cu celelalte pentru a supravietui in organismul uman, ca sa fie ele cele care cauzeaza infectia.</p>
        </div>
        <br>
        <div class="content-right">
            <h6 style="margin-bottom:10px;">Actualizare 30.06.2021</h6>
            <div class="box-info-cov">
                <div>
                    <div id="nr">196</div> Cazuri confirmate
                </div><br>
                <div>
                    <div id="nr">387</div> Cazuri vindecate
                </div><br>
                <div>
                    <div id="nr">84 </div> Persoane decedate
                </div><br>
                <div>
                    <div id="nr">20627</div> Teste efectuate
                </div><br>
                <div>
                    <div id="nr">365</div> Persoane internate la ATI
                </div><br>
                <div>
                    <div id="nr">4884</div> Persoane în izolare
                </div><br>
                <div>
                    <div id="nr">7926291</div> Vaccinări totale în România
                </div><br>
            </div>

            <h5 style="margin-bottom:10px;">Evoluția la zi</h5>
            <div class="box-info-cov">
                <div>
                    <div id="nr">1078338</div> Cazuri confirmate
                </div><br>
                <div>
                    <div id="nr">30499 </div> Total decese
                </div><br>
                <div>
                    <div id="nr">1041256</div> Cazuri vindecate
                </div><br><br>
            </div>
        </div>
        <br><br><br><br>
        <h3>Evoluția pandemiei de coronavirus pe județe</h3><br>
        <p>Urmareste evoluția pandemiei de coronavirus în România. Informațiile sunt agregate din surse oficiale și
            reflectă situația la zi a confirmărilor și a deceselor la nivelul fiecărui județ.</p><br>
        <div class="md-6">
            <iframe scrolling="no" src="https://datelazi.ro/embed/counties-map" width="720" height="620"></iframe>
        </div>
        <br><br>
    </div>
</div>

<?php require 'footer.php'; ?>