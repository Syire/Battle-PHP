# 🎯 **Battaglia Navale - PHP Edition**

Benvenuto nel gioco della **Battaglia Navale**, realizzato con **PHP** e **CSS**!

## 📘 **Descrizione**

Questa è una semplice implementazione del gioco **Battaglia Navale**, dove:

- L'intera logica è gestita in **PHP**
- L'interfaccia e la grafica sono curate con **CSS**
- Tutto funziona **lato server**, senza JavaScript


## 📂 **Struttura del Progetto**

| File        | Descrizione                                                                                                                                |
| ----------- | ------------------------------------------------------------------------------------------------------------------------------------------ |
| `index.php` | Gestisce il cuore del gioco: griglia, colpi, log e condizioni di vittoria.                                                                 |
| `login.php` | Accesso iniziale al gioco (pagina placeholder, senza autenticazione reale, con lo sporco lavoro di gestire tutte le funzioni per giocare). |
| `style.css` | Stili grafici della griglia, bottoni, log e layout della pagina.                                                                           |

## 🕹️ **Funzionamento del Gioco**

### 🔸 Posizionamento delle Navi
- Le navi vengono **posizionate casualmente** su una griglia 10x10.
- Tipi di navi e dimensioni:
  - 🚢 Portaerei → 5 celle  
  - 🛳️ Cacciatorpediniere → 4 celle  
  - 🚤 Torpediniere → 3 celle  
  - 🛥️ Sottomarino → 3 celle  
  - 🛡️ Fregata → 2 celle  

### 🎯 Sparare Colpi
- Clicca su una cella per sparare.
- **Colpito** se la nave è presente, altrimenti è un **miss** (colpo nell’acqua).
- Ogni colpo viene registrato in un **log interattivo**.

### 📜 Log dei Colpi
- Mostra lo storico dei colpi sparati: colpiti, mancati, e navi affondate.

### 🔁 Reset del Gioco
- Clicca su **"Reset Partita"** per azzerare la griglia e generare nuove navi.

### 🏆 Vittoria
- Il gioco termina quando **tutte le navi nemiche sono affondate**.
- Appare un messaggio di vittoria con la possibilità di iniziare una nuova partita.


## ⚙️ **Istruzioni per l'Uso**

1. 🔽 Clona o scarica il progetto.
2. 📁 Posiziona i file in una directory del tuo server PHP (es. `htdocs` su **XAMPP**).
3. 🧑‍💻 Avvia il server e visita `localhost/nome-cartella/login.php`.
4. 🖱️ Clicca sulla griglia per iniziare a giocare.
5. 🔄 Usa il pulsante "Reset" per iniziare una nuova partita.

## 📌 **Tecnologie Utilizzate**

- 🐘 PHP (logica di gioco)
- 🎨 CSS (stile e interfaccia utente)
- 🖥️ HTML (struttura della pagina)


> ⚠️ *Nota*: Questo progetto è didattico e non include un sistema di autenticazione reale.

## ✍️ Autore

*Progetto sviluppato per esercitazione con PHP, CSS e concetti di programmazione web.*
