@extends('layouts.appadmin')
@section('title')
    Dashboard
@endsection
@section('contenu')
    <!-- Navbar Start -->

    <!-- Navbar End -->


    <!-- Sales Chart Start -->

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class=" text-center">Liste Des Medecins</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="text-center">Nom complet</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @if($user->role == "1")
                                <tr>
                                    <td class="text-center text-white">{{$user->name}}</td>
                                    <td class="text-center text-white">{{$user->email}}</td>
                                    <td class="text-center text-white">Medecin</td>
                                    <td class="text-center text-white">
                                         <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                                             @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>


                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Liste Des Secretaires</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="text-center">Nom complet</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                @if($user->role == "2")
                                <tr>
                                    <td class="text-center text-white">{{$user->name}}</td>
                                    <td class="text-center text-white">{{$user->email}}</td>
                                    <td class="text-center text-white">Secretaire</td>
                                    <td class="text-center text-white">
                                        <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                                            @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                       </form>


                                   </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Disponibilité Des Medecin</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="text-center">Nom complet</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Heure debut</th>
                                    <th class="text-center">Heure fin</th>
                                    <th class="text-center">Etat</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $timeSlot)

                                <tr>
                                    <td class="text-center text-white">{{ $timeSlot->user->name }}</td>
                                    <td class="text-center text-white">{{ $timeSlot->date }}</td>
                                    <td class="text-center text-white">{{ $timeSlot->start_time }}</td>
                                    <td class="text-center text-white">{{ $timeSlot->end_time }}</td>
                                    @php
                                        $currentTime = time();
                                        $timeSlotDate = strtotime($timeSlot->date);
                                        $currentTime2 = date('H:i:s');
                                        $endTime = strtotime($timeSlot->end_time);
                                    @endphp
                                    @if ($timeSlotDate > $currentTime)
                                        <td class="text-center text-danger">En cours</td>
                                    @endif
                                    @if ($timeSlotDate == $currentTime)
                                        @if($endTime < $currentTime2 )
                                        <td class="text-center text-danger">En cours</td>
                                        @endif
                                        @if($endTime >= $currentTime2 )
                                        <td class="text-center text-success">Terminer</td>
                                        @endif
                                    @endif
                                    <td class="text-center text-white">
                                        <form action="{{ route('users.destroy',$timeSlot->user->id) }}" method="Post">
                                            @csrf
                                           @method('DELETE')
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                       </form>


                                   </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('scripts')

@endsection
