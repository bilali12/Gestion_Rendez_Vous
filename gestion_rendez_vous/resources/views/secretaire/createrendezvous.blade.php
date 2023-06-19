{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form action="{{route('secretaire.storeRendezVous')}}" method="post" class="form-group">
        <div class="row">
            <label for="">Nom Patient</label>
            <input type="text" name='nomPatient' class="form-control">
        </div>
        <div class="row">
            <label for="">Medecins diponibles</label>
        <select name="medecin" id="medecin"  class="form-control">
            <option value="" selected disabled>--Choisir medecin--</option>
                @foreach ($timeSlots as $timeSlot)
                <option value="{{$timeSlot->id}}">{{$timeSlot->user->name}}</option>
                @endforeach
        </select>
        </div>
        <div class="row">
            <label for="">Heure debut</label>
            <select name="heureDebut" id="heureDebut" onchange="catchHeure()">
                <option value="" selected disabled>--Choisir heure debut--</option>
                @foreach ($heures as $heure )
                    <option value="{{$heure->heure}}">{{$heure->heure}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <label for="">Heure fin</label>
        <select id="select" name="heureFin"></select>
        </div>

        <button class="btn btn-success">Ajouter</button>
    </form>
</div>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="{{route('secretaire.storeRendezVous')}}" method="post" class="form-group">
            <div class="row">
                <label for="">Nom Patient</label>
                <input type="text" name='nomPatient' class="form-control">
            </div>
            <div class="row">
                <label for="">Medecins diponibles</label>
                <select name="medecin" id="medecin" class="form-control medecin-select">
                    <option value="" selected disabled>--Choisir medecin--</option>
                    @foreach ($timeSlots as $timeSlot)
                        <option value="{{$timeSlot->id}}">{{$timeSlot->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <label for="">Heure début</label>
                <select name="heureDebut" id="heureDebut" class="heure-debut-select">
                    <option value="" selected disabled>--Choisir heure début--</option>
                </select>
            </div>
            <div class="row">
                <label for="">Heure fin</label>
                <select name="heureFin" id="heureFin" class="heure-fin-select">
                    <option value="" selected disabled>--Choisir heure fin--</option>
                </select>
            </div>
            <button class="btn btn-success">Ajouter</button>
        </form>
    </div>

    <script>
        // Récupérer les éléments select
        const medecinSelect = document.querySelector('.medecin-select');
        const heureDebutSelect = document.querySelector('.heure-debut-select');
        const heureFinSelect = document.querySelector('.heure-fin-select');

        // Gestionnaire d'événement pour le changement de sélection du médecin
        medecinSelect.addEventListener('change', function() {
            const selectedMedecinId = this.value;

            // Utiliser AJAX pour récupérer les heures de début et de fin du médecin sélectionné
            // et mettre à jour les options des éléments select correspondants

            // Exemple de code AJAX :
            // Remplacez l'URL par votre propre URL d'API ou de route
            fetch(`/medecin/heures`)
                .then(response => response.json())
                .then(data => {
                    // Mettre à jour les options des éléments select pour les heures de début et de fin
                    heureDebutSelect.innerHTML = ''; // Réinitialiser les options existantes
                    heureFinSelect.innerHTML = '';

                    // Créer de nouvelles options à partir des données récupérées
                    data.heuresDebut.forEach(heure => {
                        const option = document.createElement('option');
                        option.value = heure;
                        option.textContent = heure;
                        heureDebutSelect.appendChild(option);
                    });

                    data.heuresFin.forEach(heure => {
                        const option = document.createElement('option');
                        option.value = heure;
                        option.textContent = heure;
                        heureFinSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des heures du médecin:', error);
                });
        });
    </script>
</body>
</html>

