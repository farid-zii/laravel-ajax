<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                
                <div class="form-group">
                    <label for="name" class="control-label">Title</label> 
                    <input type="text" class="form-control" id="title">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Content</label> 
                    <textarea rows="4" class="form-control" id="content"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="store">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    //saat klik btn-create-post akan menampilkan modal-create
    $('body').on('click','#btn-create-post',function(){
        //menampilkan modal create
        $('#modal-create').modal('show');
    });

    //
    $('#store').click(function(e){
        e.preventDefault();

        //Define variable
        let title = $('#title').val();
        let content = $('#content').val();
        let token = $("meta[name='csrf-token']").attr("content");

        //AJAX
        $.ajax({
            //url utk inputan data 
          url: `/posts`,
          type: "POST",
          cache: false,
          data:{
            "title": title,
            "content": content,
            "_token": token
          },
          success:function(response){

            //Menampilkan pesan sukses
            Swal.fire({
                type: 'success',
                icon: 'success',
                title: `${response.message}`,
                showConfirmButton:false,
                timer: 3000
            });

            //data post yang akan ditampilkan pada halaman berdasarkan data yang di inputkan
            let post = `
            <tr id="index_${response.data.id}">
                <td>${response.data.title}</td>
                <td>${response.data.content}</td>
                <td class="text-center">
                <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            `;

            //Memasukkan data ke table
            $('#table-posts').prepend(post);

            //clear form
            $('#title').val('');
            $('#content').val('');

            //close modal
            $('#modal-create').modal('hide')
          },
          //Jika data tidak sesuai dengan inputan
          //maka akan menampilkan pesan error berdasarkan controller
          error:function(error){
            if(error.responseJSON.title[0]){

                //tampil alert
                    //Meanghapuskan class sebelumnya
                $('#alert-title').removeClass('d-none');
                    //Menambahakan class pada alert
                $('#alert-title').addClass('d-block');

                //Menambahkan pesan ke alert
                 $('#alert-title').html(error.responseJSON.title[0]);
            }

            if(error.responseJSON.content[0]){

                //tampil alert
                $('#alert-content').removeClass('d-none');
                $('#alert-content').addClass('d-block');

                //Menambahkan pesan ke alert
                 $('#alert-content').html(error.responseJSON.content[0]);
            }
          }

        });

    });
    
</script>