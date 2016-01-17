AUDIOBOX
=========
## Om AUDIOBOX
Audiobox är ett projektarbete som är skapat i kursen phpmvc på Blekinges Tekniska Högskola av Martin Emanuelsson. Temat för sidan är musik med inriktning progressive house och trance. Sidan ska efterlikna en blogg där man kan skapa sin egna användare och ställa frågor, kommentera med mera. Vill man inte skapa sin egna användare så kan man endast läsa frågorna och kommentarerna men inte skriva och kommentera själv.

## Enkel installation

Klona ner projektet till din www-mapp:

* git clone https://github.com/emanulzone/audiobox.git

Ställ dig sedan i projektmappen och installera dependencies:

* composer update no --dev

## htaaccess

det måste göras vissa ändringar i .htaccess filen så den stämmer för din adress/webroot. Du finner filen i phpmvc-bth/webroot/.htaccess

## Setup DB

Ändra inställningar i config-filerna för din databas. Du hittar dom här:
* phpmvc-bth/app/config/config_mysql.php
* config_with_app.php

Efter det så anger du adressen phpmvh-bth/webroot/dbsetup i din webbläsare för att köra ett script som installerar databastabellerna på din server.

Klart! :)

```
