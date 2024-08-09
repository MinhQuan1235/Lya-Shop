<link rel="stylesheet" href="css/mid.css">
<?php
	$hienthi = mysqli_query($link,"SELECT * FROM danhmucsanpham ORDER BY phanlop");
			 $dem = mysqli_num_rows($hienthi);
?>
<div class="content22">
<div class="quanly">
	<center>
	<h2 style="background-color:#ECECED; padding: 10px 0px;">QUẢN LÝ DANH MỤC</h2>
	<p >Có tổng <font color=red><b><?php echo $dem ?></b></font> danh mục</p>
	</center>
	<a class="thembtn" href='?admin=themdm' >Thêm danh mục</a>
	
</div>
<center>
<table align="center" border="0" id="tbhotro">
        <tr class="tieude">
        	<td>Mã DM</td>
           <td> Tên DM</td>
            <td>Thuộc </td>
            <td colspan=2>Active</td>
        </tr>
               
        <?php
			
			if($dem !="")
			{
				while($bien=mysqli_fetch_array($hienthi))
				{
				
		?>
                   <tr>
                   <td class="masp_hienthi_sp">
                    <?php echo $bien['madanhmucsanpham'] ?>
                   </td>
                   <td class="tensp_hienthi_sp">
                    <b><?php echo $bien['tendanhmuc'] ?></b>
                    </td>
                    <td class="masp_hienthi_sp">
					
                    <?php
						if($bien['phanlop'] ==0) {
							echo "Danh mục chính";
						}
						else {
							$laytendm = mysqli_query($link,"SELECT tendanhmuc FROM danhmucsanpham WHERE madanhmucsanpham = {$bien['phanlop']}");
							$result = mysqli_fetch_assoc($laytendm);//them dong nay
							echo $result['tendanhmuc'];
						}
						
					?>
                    </td>
					<td>
						
                    <a class="icon-suaxoa" href="?admin=suadm&madm=<?php echo $bien['madanhmucsanpham']?>" >  <i class=" icon-sua1 fa-solid fa-pen-to-square"></i></a>
					<a class="icon-suaxoa" href="?admin=xoadm&madm=<?php echo $bien['madanhmucsanpham']?>" > <i class="icon-xoa1 fa-solid fa-trash"></i></a>
					</td>
           
           
        <?php  
				}
			}
			else
				{
					echo "<tr><td colspan='5'>Không có danh mục nào </td></tr>";
				}
			
		?>
    </table>
</center>
</div>