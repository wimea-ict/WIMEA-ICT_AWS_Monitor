<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div>
  <table class="table table-stripped" id="datatable">
    <thead class="thead-dark">
    <tr>
      <th scope="col">FILE DOWNLOADS (RAW DATA)</th>
    </tr>
    </thead>

    <tbody>
    <tr>
      <td><a href="buyende1file">Buyende 1 data</a></td>
    </tr>
    <tr>
      <td><a href="buyende2file">Buyende 2 data</a></td>
    </tr>
    <tr>
      <td><a href="entebbefile">Entebbe data</a></td>
    </tr>
    <tr>
      <td><a href="jinjafile">Jinja data</a></td>
    </tr>
    <tr>
      <td><a href="kamulifile">Kamuli data</a></td>
    </tr>
    <tr>
      <td><a href="makererefile">Makerere data</a></td>
    </tr>
    <tr>
      <td><a href="mayugefile">Mayuge data</a></td>
    </tr>
    <tr>
      <td><a href="testfile">Test data</a></td>
    </tr>
    <tr>
      <td><a href="kalirofile">Kaliro data</a></td>
    </tr>
    <tr>
      <td><a href="mubendefile">Mubende data</a></td>
    </tr>
    <tr>
      <td><a href="lwengofile">Lwengo data</a></td>
    </tr>
    <tr>
      <td><a href="fosfile">FOS data</a></td>
    </tr>
    </tbody>

  </table>
</div>
<br><br>
@endsection
