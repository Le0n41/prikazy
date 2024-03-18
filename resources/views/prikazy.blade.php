<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Шаблоны приказов</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href = "{{ mix('/css/prikazy.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>

<body>
    @php
        $controllerPrikazy = new App\Http\Controllers\ControllerPrikazy();
    @endphp




    <div class="accordion" id="accordionInstitute">
        @foreach ($facultys as $inst)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $inst['id'] }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $inst['id'] }}" aria-expanded="false"
                        aria-controls="collapse{{ $inst['id'] }}">
                        {{ $inst['name'] }}
                    </button>
                </h2>
                <div id="collapse{{ $inst['id'] }}" class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $inst['id'] }}" data-bs-parent="#accordionInstitute">
                    <div class="accordion-body">
                        <div class="accordion" id="accordionFormat{{ $inst['id'] }}">
                            @foreach ($formEducation as $index => $form)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $form }}{{ $inst['id'] }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $form }}{{ $inst['id'] }}"
                                            aria-expanded="false"
                                            aria-controls="collapse{{ $form }}{{ $inst['id'] }}">
                                            {{ $formRus[$index] }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $form }}{{ $inst['id'] }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $form }}{{ $inst['id'] }}"
                                        data-bs-parent="#accordionFormat{{ $inst['id'] }}">
                                        <div class="accordion-body">
                                            @foreach ($inst->profiles as $prof)
                                                <div class="accordion"
                                                    id="accordionStream{{ $form }}{{ $inst['id'] }}">
                                                    @foreach ($prof->streams_b as $st)
                                                        {{ $st->name }}
                                                    @endforeach
                                                    @foreach ($prof->streams_m as $st)
                                                        {{ $st->name }}
                                                    @endforeach
                                                    @foreach ($prof->streams_z as $st)
                                                        {{ $st->name }}
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <script>
        function showComment(id) {
            let comment = document.getElementById('comment' + id);
            let bt_comment = document.getElementById('reqComment' + id);
            let sh_comment = document.getElementById('showComment' + id);
            comment.style.display = 'block';
            bt_comment.style.display = 'block';
            sh_comment.style.display = 'none';

        }
    </script>

</body>
<style>
    .accordion-header {
        cursor: pointer;
        border-radius: 3px;
        font-size: 14px;
        font-family: 'Helvetica Neue OTS', sans-serif;
        font-weight: 400;

    }

    .accordion-item {
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 125) !important;
        border-radius: 3px;
        margin: 1px;
    }

    .accordion-item:first-child {
        border: 1px solid rgba(0, 0, 0, 125) !important;
        margin-bottom: 0px;
    }

    .accordion-button.collapsed {
        cursor: pointer;
        border-radius: 3px !important;
        border-top-left-radius: 1px solid rgba(0, 0, 0, 125);
    }

    .accordion-collapse.collapsing {
        border-top: 1px solid rgba(0, 0, 0, 125);
    }

    .accordion-collapse.collapse {
        border-top: 1px solid rgba(0, 0, 0, 125);
    }

    .accordion-button:not(.collapsed) {
        color: #1E8EC2 !important;
        background-color: #E1F3F9 !important;
        border-radius: 3px !important;
    }

    .table {
        background: #ffffff !important;
        border-collapse: collapse;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        font-size: 14px;
        text-align: left;
        max-width: 1450px;
        min-width: 800px;
        width: 100%;
    }

    .table th,
    .table td {
        text-align: center;
    }


    .tr:nth-child(odd) .td {
        background-color: #ffffff !important;
    }

    .tr:nth-child(even) .td {
        background-color: #E1F3F9 !important;
    }

    .td:last-child .select {
        width: 100%;
    }

    .btn {
        margin-right: 5px;
        margin-left: 5px !important;
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        display: inline-block;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }

    .btn:hover {
        text-decoration: underline;
    }

    .dropdown-item1 {
        background: url(https://cdn-icons-png.flaticon.com/512/8832/8832098.png) 50% 50% no-repeat;
        background-size: cover;
        width: 30px;
        height: 30px;
    }

    .dropdown-item1:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .dropdown-item2 {
        background: url(https://cdn-icons-png.flaticon.com/512/179/179386.png) 50% 50% no-repeat;
        background-size: cover;
        width: 30px;
        height: 30px;
    }

    .dropdown-item2:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .dropdown-item3 {
        background: url(https://cdn-icons-png.flaticon.com/512/1159/1159876.png) 50% 50% no-repeat;
        background-size: cover;
        width: 30px;
        height: 30px;
    }

    .dropdown-item3:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>

</html>
