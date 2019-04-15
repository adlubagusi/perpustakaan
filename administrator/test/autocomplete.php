 
<script type="text/javascript">
		$(function(){
			$("#tes").autocomplete({
				source:"auto.php",
				minLength:2,
				select:function(event,data){
					$('input[name=nm_pasien]').val(data.item.nm_pasien);
				}
			});
		});
	</script>
        
Nomor Rm : <input type="text" id="tes" name="tes"><br>
nama pasien : <input type="text" id="nm_pasien" name="nm_pasien">

