<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Boostrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    {{-- MyStyle --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

    <div class="row mb-6" style="margin-bottom: 0rem!important;">
        <div class="col-sm-8">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Grafik</label>
                <select class="form-control kategori_grafik" style="width: 100%;" name="kategori_grafik" id="kategori_grafik">
                  <option selected="selected" value="default">-- Pilih --</option>
                  <option value="1">Semua Grafik</option>
                  <option value="2">Grafik Batang</option>
                  <option value="3">Grafik Garis</option>
              </select>
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
            <label>Pilih Agenda</label>
            <select class="form-control jenis_agenda" style="width: 100%;" name="jenis_agenda" id="jenis_agenda">
              <option selected="selected" value="default">--  --</option>
              <option value="1">Prioritas</option>
              <option value="2">Sifat</option>
              <option value="3">Urgensi</option>
          </select>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-group">
        <label>Bulan</label>
        <input type="text" class="form-control" id="filter_date" value="{{date('m-Y')}}">
    </div>
</div>
<div class="col-md-2" style="display: flex;align-items: flex-end;align-content: center;">
  <div class="form-group">
    <button type="button" id="filter" class="btn btn-block btn-primary filterData">
      <i class="ti-search"></i>
      Filter
  </button>
</div>
</div>
</div>

<code>
    <small>
      *) Untuk menampilkan data grafik, gunakan tombol filter, dan pilih kategori data.
  </small>
</code>
</div>
</div>

<figure class="highcharts-figure">
        <div id="container2"></div>
      </figure>
      <figure class="highcharts-figure">
        <div id="container3"></div>
      </figure>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script >
  $(document).ready(function() {
    $('#filter').click(function(){
        let bulanTahun = $('#filter_date').val()
        let judul = $('#jenis_agenda').val()
        let  kategori= $('#kategori_grafik').val()

        $.ajax({
            url: `/ad/${bulanTahun}`,
            type: "GET",
            cache: false,
            success:function(response){
                if(kategori == 1){
                // grafikBatang()
                console.log(response.data2)
                console.log(response.data)
                grafikBatang(response.data)
                }
                if(kategori == 2){
                    grafikBatang()
                }
            }
        })
    })

})

function grafikBatang(a) {

    $('#container2').prepend(`<h1>${a}</h1>`);

   // const data = {
   //      labels: ['dsadasd','sadas','sdaas'],
   //      datasets: [{
   //        label: 'My First dataset',
   //        backgroundColor: ['green','red'],
   //        borderColor: ['red','green'],
   //        data: ['10','20',50],
   //      }]
   //    };

   //    const config = {
   //      type: 'polarArea',
   //      data: data,
   //      options: {}
   //    };
   //    const config2 = {
   //      type: 'line',
   //      data: data,
   //      options: {}
   //    };

   //    const myChart = new Chart(
   //      document.getElementById('container2'),
   //      config
   //    );
      
}
</script>
</body>
</html>
