@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row League">
            <div class="col-lg-6">
                <h2>Matches</h2>

                <div class="row">
                    <form class="form-inline" action="league" method="post">
                        @csrf
                        {{--Team 1--}}

                        <div class="col-lg-4 col-sm-4">
                            <a name="user" > (User 1) </a>
                            <img src="images/bayern.png" class="clubTeam">
                            <span class="teamName"> <b>Bayern</b> </span>
                        </div>

                            <div class="col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" name="user">
                                    </div>
                            </div>

                            <div class="col-lg-2 col-sm-2">
                                    <div class="form-group">
                                        <input type="text"  class="form-control">
                                    </div>
                            </div>
                        <div class="col-lg-4 col-sm-4">
                            <span class="teamName"><b>atltico</b></span>
                            <img src="images/atltico.png" class="clubTeam">
                            <span> (User 2) </span>

                        </div>

{{--                        End Team 1--}}


                        <div class="col-lg-4 col-sm-4">
                            <span> (User 1) </span>
                            <img src="images/bayern.png" class="clubTeam">
                            <span class="teamName"> <b>Bayern</b> </span>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="text"  class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="text"  class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <span class="teamName"><b>atltico</b></span>
                            <img src="images/atltico.png" class="clubTeam">
                            <span> (User 2) </span>
                        </div>



                        <div class="col-lg-4">
                            <span> (User 1) </span>

                            <img src="images/bayern.png" class="clubTeam">
                            <span class="teamName"> <b>Bayern</b> </span>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="text"  class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="text"  class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <span class="teamName"><b>atltico</b></span>
                            <img src="images/atltico.png" class="clubTeam">
                            <span> (User 3) </span>
                        </div>

                        <button type="submit" id="createBtn" class="btn btn-primary">Update table</button>

                    </form>


                </div>

            </div>

            <div class="col-lg-6 clubTable">
                <h2>Table</h2>
                <table class="styled-table">
                    <thead>
                    <tr>
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
                    <tr class="active-row">
                        <td>
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="images/bayern.png" class="clubTeam">
                                </div>
                                <div class="col-lg-9" >
                                    <p class="teamName">Bayern</p>
                                </div>
                            </div>
                        </td>
                        <td>4</td>
                        <td>4</td>
                        <td>0</td>
                        <td>0</td>
                        <td>15</td>
                        <td>4</td>
                        <td>11</td>
                        <td>12</td>
                    </tr>
                    <tr >
                        <td>
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="images/atltico.png" class="clubTeam">
                                </div>
                                <div class="col-lg-9" >
                                    <p class="teamName">Atlitco</p>
                                </div>
                            </div>

                        </td>
                        <td>4</td>
                        <td>1</td>
                        <td>2</td>
                        <td>1</td>
                        <td>4</td>
                        <td>7</td>
                        <td>-3</td>
                        <td>5</td>
                    </tr>
                    <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
