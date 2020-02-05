<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="tasks mt-5">
            <h3>Мои задачи</h3>
            <div class="task__filter text-right mb-4">
                <button class="btn btn-secondary " data-toggle="modal" data-target="#filter-modal">Фильтр</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Ответственный</th>
                        <th scope="col">Разработчик</th>
                        <th scope="col">Крайний срок</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr style="color: {{$task->status->color}}">
                        <td>{{$task->name}}</td>
                        <td>{{$task->status->name}}</td>
                        <td>{{$task->user->name}}</td>
                        <td>{{$task->developer->name}}</td>
                        <td>{{$task->deadline_time->format('d.m.Y H:i')}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="GET">
                {{-- @csrf --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Фильтр</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="filter[name]" placeholder="Название"
                        value="@isset($filterRequest['name']){{$filterRequest['name']}}@endisset"
                            >
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="user-select">Ответственный</label>
                                <select id="user-select" class="custom-select" name="filter[user][]" multiple>
                                    @foreach ($filterData['users'] as $user)
                                    <option @if(isset($filterRequest['user']) && in_array($user->id,
                                        $filterRequest['user'])) selected @endif value="{{$user->id}}">{{$user->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="developer-select">Разработчик</label>
                                <select id="developer-select" class="custom-select" name="filter[developer][]" multiple>
                                    @foreach ($filterData['users'] as $user)
                                    <option @if(isset($filterRequest['developer']) && in_array($user->id,
                                        $filterRequest['developer'])) selected @endif
                                        value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="developer-select">Статус</label>
                                <select id="developer-select" class="custom-select" name="filter[status][]" multiple>
                                    @foreach ($filterData['statuses'] as $status)
                                    <option @if(isset($filterRequest['status']) && in_array($status->id,
                                        $filterRequest['status'])) selected @endif
                                        value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Крайний срок</label>
                            <div class="d-flex">
                                <input type="date" name="filter[deadline_time][from]" class="form-control"
                                    value="@if(isset($filterRequest['deadline_time']['from'])){{$filterRequest['deadline_time']['from']}}@endif">
                                <input type="date" name="filter[deadline_time][to]" class="form-control"
                                    value="@if(isset($filterRequest['deadline_time']['to'])){{$filterRequest['deadline_time']['to']}}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default">Сбросить</button>
                        <button type="submit" class="btn btn-primary">Фильтр</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>


</body>

</html>
