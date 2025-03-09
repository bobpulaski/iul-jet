<!DOCTYPE html>
<html lang="ru">

<head>
    <style>
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
            font-size: 9pt;
        }

        td {
            border: .1px solid rgb(43, 43, 43);
            padding: 8px;
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
        switch ($headerType) {
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
        @if ($isTitle === true)
            <tr>
                <td colspan="2" style="{{ $style }}">Наименование объекта</td>
                <td colspan="2">{{ $name }}</td>
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
            <td style="width: 10%;">{{ $orderNumber }}</td>
            <td style="width: 20%;">{{ $documentDesignation }}</td>
            <td style="width: 40%;">{{ $documentName }}</td>
            <td style="width: 30%;">{{ $versionNumber }}</td>
        </tr>

        {{-- Algorithm --}}
        <tr>
            <td colspan="2" style="{{ $style }}">{{ $algorithm }}</td>
            <td colspan="2">{{ $fileData[0]['hash'] }}</td>
        </tr>

        {{-- File Information --}}
        <tr>
            <td colspan="2" style="{{ $style }}">Наименование файла</td>
            <td style="width: 40%; {{ $style }}">Дата и время последнего<br>изменения файла</td>
            <td style="width: 30%; {{ $style }}">Размер файла, байт</td>
        </tr>

        <tr>
            <td colspan="2">{{ $fileData[0]['fileName'] }}</td>
            <td style="width: 40%;">{{ $fileData[0]['formattedDate'] }}</td>
            <td style="width: 30%;">{{ $fileData[0]['fileSize'] }}</td>
        </tr>
    </table>

    <table>
        {{-- Signs --}}
        <tr>
            <td style="width: 25%; {{ $style }}">Характер работы</td>
            <td style="width: 25%; {{ $style }}">Фамилия</td>
            <td style="width: 20%; {{ $style }}">Подпись</td>
            <td style="width: 30%; {{ $style }}">Дата подписания</td>
        </tr>

        @if ($responsiblePersons === [])
            <tr>
                <td style="width: 25%; {{ $style }}"></td>
                <td style="width: 25%; {{ $style }}"></td>
                <td style="width: 20%; {{ $style }}"></td>
                <td style="width: 30%; {{ $style }}"></td>
            </tr>
        @else
            @foreach ($responsiblePersons as $item)
                @php
                    $signFormattedDate = '';

                    // Проверяем, есть ли дата
                    if ($item['signdate'] !== '') {
                        // Форматируем дату
                        $dateTime = new DateTime($item['signdate']);
                        $signFormattedDate = $dateTime->format('d.m.Y'); // Форматируем дату в DD.MM.YYYY
                    }
                @endphp

                <tr>
                    <td style="width: 25%;">{{ $item['kind'] }}</td>
                    <td style="width: 25%;">{{ $item['surname'] }}</td>
                    <td style="width: 20%;"></td>
                    <td style="width: 30%;">{{ $signFormattedDate }}</td>
                </tr>
            @endforeach
        @endif
    </table>

    {{-- Footer --}}
    @if ($isFooter === true)
        <table>
            <tr>
                <td style="width: 30%;" rowspan="2">Информационно-удостоверяющий лист</td>
                <td style="width: 40%;" rowspan="2">{{ $description }}</td>
                <td style="width: 15%;">лист</td>
                <td style="width: 15%;">листов</td>
            </tr>
            <tr>
                <td>{{ $page }}</td>
                <td>{{ $pages }}</td>
            </tr>
        </table>
    @endif



</body>

</html>
