<script>
	$('body').on('click', '#btn-delete-post',function(){
		let post_id = $(this).data('id')
		let a =$('#aa').text();
		let token = $("meta[name='csrf-token']").attr("content");

		Swal.fire({
			title:'Apakah kamu yakin',
			text: "ingin menghapus data  ini",
			icon: 'warning',
			showConfirmButton:true,
			cancelButtonText: 'TIDAK',
			confirmButtonText: 'YA, HAPUS!'
		}).then((result)=>{
			if(result.isConfirmed){

				$.ajax({
					url:`/posts/${post_id}`,
					type:'DELETE',
					cache: false,
					data:{
						"_token":token
					},
					success:function(response){

						Swal.fire({
							type:'success',
							icon:'success',
							title:`${response.message}`,
							showConfirmButton:false,
							timer: 3000
						});

						$(`#index_${post_id}`).remove();
					}
				});	
			}
		})
	})
</script>