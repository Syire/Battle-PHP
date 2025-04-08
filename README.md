# **Battaglia Navale - PHP Version**

## **Descrizione**
Questo progetto implementa il gioco della **Battaglia Navale** utilizzando **PHP** e **CSS**. L'utente può posizionare delle navi su una griglia 10x10 e lanciare colpi, cercando di colpire le navi dell'avversario. La logica del gioco è gestita interamente in PHP, mentre il layout e lo stile visivo sono gestiti tramite CSS.

## **Struttura del Codice**

1. **`index.php`**:
   - Gestisce l'intero gioco, inclusi il posizionamento delle navi, la gestione dei colpi (colpito o acqua) e il log degli eventi.
   - Mostra la griglia di gioco e consente all'utente di sparare cliccando sulle celle.

2. **`login.php`**:
   - Serve come una semplice pagina di login (non implementata con un sistema di autenticazione vero e proprio).

3. **`style.css`**:
   - Gestisce gli stili per la griglia, il log dei colpi e il pulsante di reset.
   - Personalizza l'aspetto della pagina e i pulsanti di interazione.

## **Funzionamento del Gioco**

1. **Posizionamento delle Navi**: Le navi vengono posizionate casualmente all'interno della griglia 10x10. Ogni nave ha una lunghezza diversa (Portaerei: 5, Cacciatorpediniere: 4, Torpediniere: 3, Sottomarino: 3, Fregata: 2).

2. **Sparare Colpi**: L'utente può sparare colpi cliccando sulle celle della griglia. Se una cella contiene una nave, il colpo è "colpito", altrimenti è un "miss". Ogni colpo è registrato nel log.

3. **Log dei Colpi**: Ogni volta che viene sparato un colpo, viene aggiunto un log che indica se è stato un colpo a segno, un "miss" o un "colpo nell'acqua". Il log viene visualizzato accanto alla griglia di gioco.

4. **Reset del Gioco**: Un pulsante "Reset" consente di avviare una nuova partita, azzerando la griglia e riposizionando le navi.

5. **Vittoria**: Il gioco termina quando tutte le navi dell'avversario sono state affondate. Il messaggio di vittoria viene mostrato e si può avviare una nuova partita.

## **Istruzioni per l'Uso**

1. Scarica o clona il progetto.
2. Posiziona i file in una cartella accessibile da un server PHP (come XAMPP o un server remoto).
3. Accedi al file `login.php` per iniziare a giocare.
4. Interagisci con il gioco cliccando sulla griglia per sparare.
5. Clicca su "Reset Partita" per iniziare una nuova partita.

## **Possibili Miglioramenti**
- Implementare un sistema di **autenticazione** completo nel file `login.php`.
- Aggiungere una modalità **multiplayer**.
- Creare un'intelligenza artificiale per giocare contro il computer.

