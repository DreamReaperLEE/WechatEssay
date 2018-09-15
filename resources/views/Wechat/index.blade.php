
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>微信小助手</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('js/jquery-3.3.1.min.js') }}"><\/script>')</script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css') }}">

    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="{{ asset('js/datatable/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/datatable/dataTables.bootstrap4.js') }}"></script>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Catalogue</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">政政最帅</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Wechat Search <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Wechat Search</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addline">Add</button>
                <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#upload">Import File</button>
                <a href="/download"><button class="btn btn-sm btn-outline-secondary">Export File</button></a>
              </div>
            </div>
          </div>
          @if ($add!='false')
            <div class="alert alert-success" role="alert">
              {{ $add}}
            </div>
          @endif
          <div class="table-responsive">
            <table class="table table-striped table-sm" id="table_id_example">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>文章标题</th>
                  <th>来源</th>
                  <th>点击数</th>
                  <th>阅读量</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $user)
                  <tr>
                    <td>{{ $user['id']}}</td>
                    <td>{{ $user['title']}}</td>
                    <td>{{ $user['source']}}</td>
                    <td>{{ $user['click']}}</td>
                    <td>{{ $user['read']}}</td>
                    <td><a href="/delete?id={{$user['id']}}}" onclick="return del();" ><button type="button" class="btn btn-sm btn-dark">Delete</button></a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>


    <!--批量上传-->
    <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">上传文件（XLS/XLSX格式）</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form class="form-horizontal" action="/upload" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <input class="form-control" name="file" type="file" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">提交</button>
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">关闭</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--添加单个文章-->
    <div class="modal fade" id="addline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel1">添加文章</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          </div>
          <form class="form-horizontal" action="/addline" method="post">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label">文章标题</label>
                <input type="text" class="form-control" name="title">
              </div>
              <div class="form-group">
                <label class="control-label">文章来源</label>
                <input type="text" class="form-control" name="source">
              </div>
              <div class="form-group">
                <label class="control-label">点击量</label>
                <input type="number" class="form-control" name="click">
              </div>
              <div class="form-group">
                <label class="control-label">阅读量</label>
                <input type="number" class="form-control" name="read">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-success">提交</button>
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">关闭</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Icons -->
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#table_id_example').DataTable();
        } );
        $('#table_id_example').DataTable( {
            scrollY: 400,
            language: {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上页",
                    "sNext": "下页",
                    "sLast": "末页"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                }
            }
        } );
      feather.replace()
    </script>
    {{--删除函数--}}
    <script>
        function del() {
            var msg = "您真的确定要删除吗？\n\n请确认！";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        }
    </script>
  </body>
</html>
