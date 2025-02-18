<!DOCTYPE html>
<html lang="ru">

<head>
    <style>
        body {
            font-family: 'Calibri';
            font-size: 11pt;
        }

        * {
            font-family: 'Calibri';
            font-size: 11pt;
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
            border: .5px solid black;
            border-spacing: 0px;
            width: 100%;
            text-align: center;
        }

        td {
            border: .1px solid rgb(43, 43, 43);
            padding: 12px;
        }

        body>div+div {
            page-break-before: always;
        }

        div>*:first-child {
            page-break-before: auto;
        }

        @page page1 {
            size: A4 portrait;
            margin-right: 1in;
            margin-left: 1in;
            margin-top: 1in;
            margin-bottom: 1in;
        }
    </style>
</head>

<body>

    @php

    @endphp

    <h1>PDF From Blade</h1>
    <div style='page: page1'>
        <table>
            <tr>
                <td style="width: 10%">Номер<br>п/п</td>
                <td style="width: 20%">Обозначение<br>документа</td>
                <td style="width: 40%">Наименование документа</td>
                <td style="width: 30%">Номер последнего<br>изменения (версии)</td>
            </tr>
            <tbody></tbody>
        </table>
        <div style='page: page1'>

            <p>hash: {{ $fileData[0]['hash'] }}</p>
            <p>fileName: {{ $fileData[0]['fileName'] }}</p>

            {{-- TITLE --}}
            @if ($isTitle === true)
                <h3>Title is enabled</h3>
            @elseif($isTitle === false)
                <h3>Title is disabled</h3>
            @else
                <h3>Title status is unknown</h3>
            @endif

            {{-- FOTER --}}
            @if ($isFooter === true)
                <h3>Footer is enabled</h3>
            @elseif($isFooter === false)
                <h3>Footer is disabled</h3>
            @else
                <h3>Footer status is unknown</h3>
            @endif
</body>

</html>
