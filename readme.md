# BoolBnB
BoolBnB è il progetto finale del corso Boolean Careers Full Stack Web Developer (III classe), ideato per poter utilizzare tutte le tecnologie e metodologie studiate durante il corso.

## Tempistiche di realizzazione
Il progetto è stato sviluppato in circa 3 settimane da un team remoto di 3 persone.

## Brief
BoolBnB è una applicazione per trovare e gestire l’affitto di appartamenti.
Attraverso BoolBnB gli utenti registrati possono inserire le informazioni degli appartamenti che vogliono mettere in affitto, inoltre possono decidere di pagare per sponsorizzare gli annunci per fare in modo che siano in evidenza rispetto a quelli non sponsorizzati.
Gli utenti interessati ad un appartamento, utilizzando i filtri di una apposita pagina di ricerca, vedono una lista di possibili appartamenti e cliccando su ognuno possono vedere una pagina di dettaglio.
Una volta trovato l’appartamento desiderato, l’utente interessato può contattare l’utente proprietario tramite messaggio.

## Metodologia di lavoro
### Fasi di lavoro
1. Briefing e realizzazione di una flowchart per il database.
2. Scaffolding iniziale con la creazione di tutti i file (senza contenuto) necessari per lo sviluppo completo del progetto.
3. Suddivisione dei compiti in base alle diverse aree del sito. Tutti i membri del team hanno sviluppato sia backend che frontend.
4. Incontri giornalieri per verificare lo stato del lavoro e assegnazione dei successivi compiti.

### Nel dettaglio
Si è dato maggiore risalto alla realizzazione delle funzionalità backend snellendo la parte frontend grazie all'utilizzo di Bootstrap.
Nella fase finale del progetto si è passati alla realizzazione di un layout adhoc, ideato appositamente per rispondere alle esigenze di progetto, somiglianza ad AirBnb, ma allo stesso tempo essere velocemente riproducibile con l'ausilio di Bootstrap.

## Tecnologie usate
Laravel, Vue, Jquery.

Stack LAMP

## Requisiti Tecnici richiesti da brief
1. **Client-side Validation**: tutti gli input inseriti dell’utente devono essere controllati client-side (oltre che server-side)
2. **Salvataggio informazioni di geografiche**: i dati riguardanti l’ubicazione degli appartamenti devono essere salvati sul database con latitudine e longitudine. Utilizzare: https://ubilabs.github.io/geocomplete/
3. **Sistema di Pagamento**: il sistema di pagamento da utilizzare è braintree (https://www.braintreepayments.com/ ).
4. **Il sito deve essere responsive**: il sito deve essere correttamente visibile da desktop e da smartphone


## Come visionare il progetto
**Attenzione: è necessaria una google api key**

Una volta scaricato il progetto con git clone o download, duplicare il file `.evn-example` rinominandolo in `.env`
Modificare le seguenti righe:

```
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=password

GOOGLE_API_KEY="Your_Api_Key"

BRAINTREE_ENV=sandbox
BRAINTREE_MERCHANT_ID=id
BRAINTREE_PUBLIC_KEY=key
BRAINTREE_PRIVATE_KEY=privatekey
```

Da linea di comando digitare
```
composer install
```

Generare la key Laravel
```
php artisan key:generate
```

Per poter visualizzare correttamente le immagini creare un symlink storage
```
cd public
rm storage
cd ..
php artisan storage:link
```

Generazione delle tabelle DB:
```
php artisan migrate
php artisan db:seed
```

**Attenzione: la generazione delle tabelle richiederà diversi minuti**
Nel caso vogliate velocizzare la procedura, aprire il file `database/data/comuni.json` ed eliminare alcuni indirizzi.

Nel caso invece desideriate inserire più appartamenti è presente un secondo file `database/data/comuni_more.json`

Avviare il server alla porta 8000
```
php artisan serve
```


#### Disclaimer
La lista dei comuni è stata generata utilizzando il database: https://github.com/MatteoHenryChinaski/Comuni-Italiani-2018-Sql-Json-excel

Le fotografie provengono dal sito:
https://www.pexels.com/
