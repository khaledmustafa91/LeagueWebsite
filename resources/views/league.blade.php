@extends('layouts.app')

@section('content')
    {{  ($players[0]->Name) }}

    <div class="container" >
        <div class="row League">
            <div class="col-lg-12">

                <h1 style="margin-top: 25px;"> {{$league->Name}}  </h1>
                <p> League id is : <b>{{$league->id}}</b> </p>
                <h2>Matches</h2>

                <div class="row">
                    <form class="form-inline" action="/league/{{$league->id}}" method="post">
                        @csrf
                        {{--Team 1--}}
                        <p hidden>{{ $count = 0 }} </p>

                        @for($i = 0 ; $i < count($leaguePlayers) ; $i++)
                            @for($j = $i+1 ; $j < count($leaguePlayers) ; $j++)
                                <div class="col-lg-4 col-sm-4">

                                    <img src="{{asset('images/'.$leaguePlayers[$i]->club[0]->path)}}" class="clubTeam">
                                    <input type="text" value="{{$leaguePlayers[$i]->id}}" name="player[]" hidden>
                                    <span class="teamName"> <b>{{$leaguePlayers[$i]->club[0]->Name}}</b> </span>
                                    <span name="user" > ({{$leaguePlayers[$i]->Name}}) </span>
                                </div>

                                    <div class="col-lg-1 col-sm-2">
                                            <div class="form-group">
                                                <input type="text" value="{{ (isset($allMatches[$count][0]->result1) ) ? $allMatches[$count][0]->result1 : "" }}"  class="form-control" name="resPlayers[]">
                                            </div>
                                    </div>
                                    <div class="col-lg-1" style="margin-top: 20px;margin-left: 15px; ">
                                        <h6> {{ (isset($allMatches[$count][0]->result2)) ? "VS":"Pending"  }} </h6>
                                    </div>
                                    <div class="col-lg-1 col-sm-2">
                                            <div class="form-group">
                                                <input value="{{ (isset($allMatches[$count][0]->result2)) ? $allMatches[$count][0]->result2 : ""  }}" type="text"  class="form-control" name="resPlayers[]">
                                            </div>
                                    </div>
                                <div class="col-lg-4 col-sm-4">
                                    <img src="{{asset('images/'.$leaguePlayers[$j]->club[0]->path)}}" class="clubTeam">
                                    <span class="teamName"><b>{{$leaguePlayers[$j]->club[0]->Name}}</b></span>
                                    <span> ({{$leaguePlayers[$j]->Name}}) </span>
                                    <input type="text" value="{{$leaguePlayers[$j]->id}}" name="player[]" hidden>

                                </div>
                                <p hidden>{{ $count++ }} </p>
                            @endfor

                        @endfor
{{--                        End Team 1--}}


{{--                        <div class="col-lg-4 col-sm-4">--}}
{{--                            <span> (User 1) </span>--}}
{{--                            <img src="{{asset('images/bayern.png')}}" class="clubTeam">--}}
{{--                            <span class="teamName"> <b>Bayern</b> </span>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text"  class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text"  class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <span class="teamName"><b>atltico</b></span>--}}
{{--                            <img src="{{asset('images/atltico.png')}}" class="clubTeam">--}}
{{--                            <span> (User 2) </span>--}}
{{--                        </div>--}}



{{--                        <div class="col-lg-4">--}}
{{--                            <span> (User 1) </span>--}}

{{--                            <img src="{{asset('images/bayern.png')}}" class="clubTeam">--}}
{{--                            <span class="teamName"> <b>Bayern</b> </span>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text"  class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="col-lg-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text"  class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-4">--}}
{{--                            <span class="teamName"><b>atltico</b></span>--}}
{{--                            <img src="{{asset('images/atltico.png')}}" class="clubTeam">--}}
{{--                            <span> (User 3) </span>--}}
{{--                        </div>--}}

                        <button type="submit" id="UpdateBtn" class="btn">Update table</button>

                    </form>


                </div>

            </div>

            <div class="col-lg-12 clubTable">
                <h2>Table</h2>
                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Player</th>
                        <th>Club</th>
                        <th>MP</th>
                        <th>W</th>
                        <th>D</th>
                        <th>L</th>
                        <th>GF</th>
                        <th>GA</th>
                        <th>GD</th>
                        <th>Pts</th>
                    </tr>
                    </thead>
                    <tbody>

                    @for($i = 0 ; $i < count($players) ; $i++)
                        <tr class= {{ ($i == 0) ? "active-row" : ""}}>
                            <td>{{$players[$i]->Name}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{asset('images/'.$players[$i]->club[0]->path)}}" class="clubTeam">
                                    </div>
                                    <div class="col-lg-9" >
                                        <p class="teamName">{{$players[$i]->club[0]->Name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{$players[$i]->MP}}</td>
                            <td>{{$players[$i]->W}}</td>
                            <td>{{$players[$i]->D}}</td>
                            <td>{{$players[$i]->L}}</td>
                            <td>{{$players[$i]->GF}}</td>
                            <td>{{$players[$i]->GA}}</td>
                            <td>{{$players[$i]->GD}}</td>
                            <td>{{$players[$i]->Pts}}</td>
{{--                            <td>4</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>0</td>--}}
{{--                            <td>15</td>--}}
{{--                            <td>4</td>--}}
{{--                            <td>11</td>--}}
{{--                            <td>12</td>--}}
                        </tr>

                    @endfor

{{--                    <tr >--}}
{{--                        <td>Hossam</td>--}}
{{--                        <td>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-3">--}}
{{--                                    <img src="{{asset('images/atltico.png')}}" class="clubTeam">--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-9" >--}}
{{--                                    <p class="teamName">Atlitco</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </td>--}}
{{--                        <td>4</td>--}}
{{--                        <td>1</td>--}}
{{--                        <td>2</td>--}}
{{--                        <td>1</td>--}}
{{--                        <td>4</td>--}}
{{--                        <td>7</td>--}}
{{--                        <td>-3</td>--}}
{{--                        <td>5</td>--}}
{{--                    </tr>--}}
                    <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
