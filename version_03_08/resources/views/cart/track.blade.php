@extends('layouts.app')


@section('styles.header')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="page-header">
                <h1>Purchase tracking</h1>
                
                <table id="table" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>P.O Num</th>
                            <th>Create_Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(function(){
            $('#table').DataTable({
                processing:true,
                serverSide:true,
                ajax:'/track',
                columns:[
                    {data: 'id',
                    render: function (data, type, row, meta){
                            console.log(row);
                            return  `<a href= 'track/${row.id}'>${row.id}</a>`;
                        }
                    },
                    {data: 'created_at'}
                ]
            });
        });
    </script>

@endsection