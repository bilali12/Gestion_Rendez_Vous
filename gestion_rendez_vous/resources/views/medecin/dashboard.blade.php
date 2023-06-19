@extends('layouts.appmed')
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
                        <h3 class=" text-center">Mes Rendez-Vous</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="text-center">Patient</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Heure Debut</th>
                                    <th class="text-center">Heure</th>
                                    <th class="text-center">Etat</th>
                                </tr>
                            </thead>
                            <tbody>


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
