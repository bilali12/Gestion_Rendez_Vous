<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and other imports... -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function catchHeure() {
            var selectElement = document.getElementById('select');
            selectElement.innerHTML = "";
            var selectedHeureDebut = $('select[name="heureDebut"]').val();

            $.ajax({
                url: '/heures',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    var option = document.createElement('option');
                    option.text = "Selectionnez une heure de fin";
                    selectElement.appendChild(option);

                    response.forEach(function(value) {
                        if (timeToMinutes(selectedHeureDebut) < timeToMinutes(value.heure)) {
                            var option = document.createElement('option');
                            option.value = value.heure;
                            option.text = value.heure;
                            selectElement.appendChild(option);
                        }
                    });
                },
                error: function(error) {
                    console.error('Request error:', error);
                }
            });
        }

        function timeToMinutes(time) {
            var parts = time.split(":");
            return parseInt(parts[0]) * 60 + parseInt(parts[1]);
        }
    </script>
</head>
<body>
    <form class="form-group" action="{{route('admin.storedispo')}}" method="post">
        @csrf
        <label for="">Liste des medecins</label>
        <select name="medecinID" id="">
            <option value="" selected disabled>--Selectionner medecin--</option>
            @foreach ($users as $user)
                @if($user->role == '1')
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endif
            @endforeach
        </select>
        <label for="">Dates</label>
        <select name="dates" id="">
            <option value="" selected disabled>--Choisir date--</option>
            @foreach ($dates as $date )
                @if(strtotime($date) >= time())
                    <option value="{{$date}}">{{$date}}</option>
                @endif
            @endforeach
        </select>
        <label for="">Heure debut</label>
        <select name="heureDebut" id="heureDebut" onchange="catchHeure()">
            <option value="" selected disabled>--Choisir heure debut--</option>
            @foreach ($heures as $heure )
                <option value="{{$heure->heure}}">{{$heure->heure}}</option>
            @endforeach
        </select>

        <label for="">Heure fin</label>
        <select id="select" name="heureFin"></select>

        <button type="submit" class="btn btn-success">Ajouter</button>
        <div class="alert badge-danger" style="color: crimson">{{ session('erreur') }}</div>
    </form>
</body>
</html>
