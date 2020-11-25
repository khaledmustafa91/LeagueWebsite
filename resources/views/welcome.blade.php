@extends('layouts.app')
@section('content')
{{--    <div class="contain">--}}
        <div class="overlay"></div>
        <div class="mainDiv"></div>
        <div class="Hometext text-center">
            <h2>Make your league Now</h2>
            <a href="#howItWorks" type="button" class="btn btn-info" id="bot"> Let's start</a>
        </div>
        <section class="howItWorks text-center" id="howItWorks">
            <div class="container">
                <h1>How it works</h1>
                <p>Here some tips to create your league</p>
                <div class="row">
                    <div class="col-lg-4">

                        <i class="fa fa-list-ol fa-5x"></i>
                        <h2>Number of players</h2>
                        <p>Enter number of players and teams </p>
                    </div>

                    <div class="col-lg-4">

                        <i class="fa fa-futbol-o fa-5x"></i>
                        <h2>Get league matches</h2>
                        <p>get you league matches to play with your friends</p>

                    </div>

                    <div class="col-lg-4">

                        <i class="fa fa-table fa-5x"></i>
                        <h2>Final results</h2>
                        <p>Enter all results of matches to get your league table </p>
                    </div>
                </div>
            </div>

        </section>


<section class="text-center Data" id="getData">
    <div class="container">

            <h1>Get your data</h1>
            <p>Now enter number of players and their teams</p>
            <div class="row">
                <div class="col-lg-9">
                    <form action="">
                        <div class="form-group row ">
                            <label for="numOfPlayers">Number of players</label>
                            <input type="text" class="form-control" id="numOfPlayers" placeholder="number of players ">
                        </div>

                        <div class="row">
                            <div class="col-lg-6 alert alert-danger" id="numberError"  >
                                <p> Please enter a valid number</p>
                            </div>
                            <div class="form-group col-lg-6">
                                <button class="btn " id="generateBtn">Generate teams</button>
                            </div>

                        </div>


                        <div id="teamsInfo" >
                            <div class="form-group row" id="allInfo" style="display: none">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Team Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="inputPassword" placeholder="Password">
                                </div>

                                <label for="inputPassword" class="col-sm-2 col-form-label">Player Name</label>
                                <div class="col-sm-4">
                                    <select class="custom-select">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 leftImage">

                </div>
            </div>
    </div>

</section>
{{--    </div>--}}
@endsection
