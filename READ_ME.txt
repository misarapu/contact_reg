
Mikk Sarapuu
10151716

http://enos.itcollege.ee/~misarapu/contacts_reg/main/main_page.php

/** Rakendus ei tööta täisväärtuslikult IE korral **/

Githubi kood pole seotud enose serveriga.

Tegemist on kontaktide registriga. Kasutaja saab lisada registrisse uusi
kontakte. Kontaktide sisestamiseks on vajalik kontakti eesnimi, perekonnanimi,
kategooria, sünnikuupäev, telefoninumber ja emailiaadress. Kontakti sisestamise
vormi peab täitma korrektselt. Seda kontrollitakse nii rakenduse ja serveri
poolel. Valede sisestuste korral edastatakse kasutajale vastavate vigade kohta
märkus.

Kui kontakti andmed on edukalt andmebaasi edastatud, kuvatakse kontakt
terviklikus tabelis, kus näeme iga kontakti id väärtust, eesnime, perekonnanime,
sünnikuupäeva järgi arvutatud vanust, ühte telefoninumbrit, ühte emailiaadressi
ja kategooriat. Seejärel saab iga kontakti telefoninumbreid ja emailiaadresse
muuta ja kustutada või saab uusi andmeid lisada. Tabeli iga rea lõpus on nupp,
mis kustutab andmebaasist kontakti ja temaga kaasas käivad andmed. Tabelit
uuendatakse dünaamiliselt. Selleks kasutatakse AJAXit.

Vasakpoolne menüü ei oma iseseisvalt mingit funktsiooni, vaid jäi sinna varasema
töö tulmusena. Sealhulgas ei tööta ka otsingufunktsioon. Uue kontakti lisamisel
menüüd siis uuendatakse ja menüüga käivad kaasas kaks nuppu. Ülemine nupp kuvab
kontakti lisamise vormi ja alumisega saab rakendusest välja logida.

Iseseisvad koodi osad on püütud ära jagada erinevates failides.

Kõige keerulisem oli andmebaasist päringute tegemine. Proovisin talitleda nii,
et peaks sarnaste päringute korral võimalikult vähe koodi kirjutama, kuid
lõpuks osutuks ainukeseks töötavaks variandiks, kui sama koodi väikeste
variatsioonidega ümber trükkida. Võib olla nii peabki, aga ei usu.

Kuna otsustasin kasutada AJAXit, siis tundus ka see alguses keeruline. Oleks
soovinud lisada ka AJAXi põhise live otsingu ja lehitsemise meetodi. Esimest ma
ei hakanud lisama, sest see oleks eeldanud ka, et muu koodi suuremat
ümberkirjutamist, selleks et otsingu tulemusi ilusti kuvada. Lehitsemist oleks
tahtnud AJAXiga teha, kuid ei osanud.

Samuti kasutasin palju html elementide id-dega manipuleerimist. Kõik töötab,
aga muudab koodi jälgimise üsna segaseks. Kui nii tehaksegi, siis arvan, et olen
selles päris osav, aga kahtlen, et korrektne lähenemine selline võiks olla.

--------------------------------------------------------------------------------

Tagasiside:

Sain projekti kätte, see sobib väga hästi. id’de asemel kasutatakse metainfo 
jaoks tavaliselt data-* atribuute, mis on mugavam kui id või class väärtustega 
toimetamine, kuna neid saab kasutada selektoris ning neid saab lisada ühele elemendile 
mitu https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Using_data_attributes.
Samas muidugi võib ka nii, peaasi et töötab