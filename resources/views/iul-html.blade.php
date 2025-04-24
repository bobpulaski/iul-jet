<!DOCTYPE html>
<html lang="ru">

<head>
    <style>
        body {
            padding: 1rem;
        }

        a.NoteRef {
            text-decoration: none;
        }

        hr {
            height: 1px;
            padding: 0;
            margin: 1em 0;
            border: 0;
            border-top: .1px solid #CCC;
        }

        table {
            border-spacing: 0px;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        td {
            /* border: .1px solid rgb(43, 43, 43); */
            padding: 8px;
        }

        table,
        th,
        td {
            border: .1px solid black;
        }

        body>div+div {
            page-break-before: always;
        }

        div>*:first-child {
            page-break-before: auto;
        }

        /* @page page1 {
            size: A4 portrait;
            margin-right: 1in;
            margin-left: 1in;
            margin-top: 1in;
            margin-bottom: 1in;
        } */
    </style>
</head>

<body>

    @php

        // dd($data);

        switch ($data['headerType']) {
            case 'bold':
                $style = 'font-weight: bold; font-style: normal;';
                break;

            case 'italic':
                $style = 'font-weight: normal; font-style: italic;';
                break;

            case 'italic-bold':
                $style = 'font-weight: bold; font-style: italic;';
                break;

            default:
                $style = 'font-weight: normal; font-style: normal;';
                break;
        }

    @endphp

    <p style="font-size: larger">Информационно-удостоверяющий лист</p>


    <table>

        {{-- Title --}}
        @if ($data['isTitle'])
            <tr>
                <td colspan="2" style="{{ $style }}">Наименование объекта</td>
                <td colspan="2">{{ $data['name'] }}</td>
            </tr>
        @endif

        {{-- Main Information --}}
        <tr>
            <td style="width: 10%; {{ $style }}">Номер<br>п/п</td>
            <td style="width: 20%; {{ $style }}">Обозначение<br>документа</td>
            <td style="width: 40%; {{ $style }}">Наименование документа</td>
            <td style="width: 30%; {{ $style }}">Номер последнего<br>изменения (версии)</td>
        </tr>

        <tr>
            <td style="width: 10%;">{{ $data['orderNumber'] }}</td>
            <td style="width: 20%;">{{ $data['documentDesignation'] }}</td>
            <td style="width: 40%;">{{ $data['documentName'] }}</td>
            <td style="width: 30%;">{{ $data['versionNumber'] }}</td>
        </tr>

        {{-- Algorithm --}}
        <tr>
            <td colspan="2" style="{{ $style }}">{{ $data['algorithm'] }}</td>
            <td colspan="2">{{ $data['fileData'][0]['hash'] }}</td>
        </tr>

        {{-- File Information --}}
        <tr>
            <td colspan="2" style="{{ $style }}">Наименование файла</td>
            <td style="width: 40%; {{ $style }}">Дата и время последнего<br>изменения файла</td>
            <td style="width: 30%; {{ $style }}">Размер файла, байт</td>
        </tr>

        <tr>
            <td colspan="2">{{ $data['fileData'][0]['fileName'] }}</td>
            <td style="width: 40%;">{{ $data['fileData'][0]['formattedDate'] }}</td>
            <td style="width: 30%;">{{ $data['fileData'][0]['fileSize'] }}</td>
        </tr>
    </table>

    <table style="border-top: none;">
        {{-- Signs --}}
        <tr style="border-top: none;">
            <td style="width: 25%; border-top: none; {{ $style }}">Характер работы</td>
            <td style="width: 25%; border-top: none; {{ $style }}">Фамилия</td>
            <td style="width: 20%; border-top: none; {{ $style }}">Подпись</td>
            <td style="width: 30%; border-top: none; {{ $style }}">Дата подписания</td>
        </tr>


        @foreach ($data['responsiblePersons'] as $item)
            @php
                $signFormattedDate = '';

                // Проверяем, есть ли дата
                if ($item['signdate'] !== null) {
                    // Форматируем дату
                    $dateTime = new DateTime($item['signdate']);
                    $signFormattedDate = $dateTime->format('d.m.Y'); // Форматируем дату в DD.MM.YYYY
                }
            @endphp

            <tr>
                <td style="width: 25%;">{{ $item['kind'] }}</td>
                <td style="width: 25%;">{{ $item['surname'] }}</td>

                @if ($item['file_src'])
                    <td style="width: 20%;">
                        <img src="{{ asset('storage/' . $item['file_src']) }}" width="150" height="100">
                    </td>
                @else
                    <td style="width: 20%;"></td>
                @endif

                <td style="width: 30%; height: 2rem;">{{ $signFormattedDate }}</td>
            </tr>
        @endforeach
    </table>

    {{-- Footer --}}
    @if ($data['isFooter'])
        <table style="border-top: none;">
            <tr>
                <td style="width: 30%; border-top: none;" rowspan="2">Информационно-удостоверяющий лист</td>
                <td style="width: 40%; border-top: none;" rowspan="2">{{ $data['description'] }}</td>
                <td style="width: 15%; border-top: none;">лист</td>
                <td style="width: 15%; border-top: none;">листов</td>
            </tr>
            <tr>
                @if ($data['page'] === '')
                    <td>&nbsp;</td>
                @else
                    <td>{{ $data['page'] }}</td>
                @endif

                @if ($data['pages'] === '')
                    <td>&nbsp;</td>
                @else
                    <td>{{ $data['pages'] }}</td>
                @endif
            </tr>
        </table>
    @endif



</body>

</html>
