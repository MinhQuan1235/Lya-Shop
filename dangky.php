<link rel="stylesheet" href="css/dangnhap.css">
<form action="update_dangky.php" method="post" name="frm" onsubmit="return dangky()">


	<div class="fromdangky" id="signup">
	<h1 style="padding-top: 20px; padding-bottom: 20px; display: flex; justify-content: center;">Đăng ký</h1>
	<center>

		<table>
        <tr>
            <td>Tên người dùng <font color="red">*</font> </td><td class="input"><input type="text" name="tennd" size="40"></td>
        </tr>
		<tr>
			<td>Tên đăng nhập  <font color="red">*</font> </td><td class="input"> <input type="text" name="user" size="40"></td>
		</tr>
		<tr>
			<td>Mật khẩu <font color="red">*</font> </td><td class="input"><input type="password" name="pass" size="40" ></td>
		</tr>
		<tr>
			<td>Nhập lại mật khẩu <font color="red">*</font> </td><td class="input"><input type="password" name="pass1" size="40"></td>
		</tr>
		<tr>
			<td>Ngày sinh </td><td class="input"><input type="date" name="ngaysinh"></td>
		</tr>
		<tr>
			<td>Email <font color="red">*</font> </td><td class="input"><input type="text" name="email" size="40"></td>
		</tr>
		<tr>
			<td>Điện thoại <font color="red">*</font> </td><td class="input"><input type="text" name="dienthoai" size="40"></td>
		</tr>
		<tr>
			<td>Địa chỉ  </td><td class="input"><textarea name="diachi"></textarea></td>
		</tr>
		
	</table>
</center>
		
			
			<div class="btndangky">
				<button type="submit"  name="submit">Đăng ký</button>
				<button type="reset">Hủy</button>
			</div>
		
	</div>
</form>

<script language="javascript">
 	function  dangky()
	{
	    if(frm.tennd.value=="")
		{
			alert("Bạn chưa nhập tên. Vui lòng kiểm tra lại");
			frm.tennd.focus();
			return false;	
		}
		if(frm.tennd.value.length<6)
		{
			alert("Tên quá ngắn. Vui lòng điền đầy đủ tên");
			frm.tennd.focus();
			return false;	
		}
		if(frm.user.value=="")
	 	{
			alert("Bạn chưa nhập tên đăng nhập . Vui lòng kiểm tra lại");
			frm.user.focus();
			return false;	
		}
		if(frm.user.value.length<6)
	 	{
			alert("Tên đăng nhập phải lớn hơn 6 ký tự");
			frm.user.focus();
			return false;	
		}
		if(frm.pass.value=="")
		{
			alert("Bạn chưa nhập password");	
			frm.pass.focus();
			return false;
		}
		if(frm.pass.value.length<6)
		{
			alert("Mật khẩu phải lớn hơn 6 ký tự");	
			frm.pass.focus();
			return false;
		}
	   dt=/^[0-9]+$/;
	   dienthoai=frm.dienthoai.value;
	   if(!dt.test(dienthoai))
	   {
		    alert("Bạn chưa nhập điện thoại. Vui lòng kiểm tra lại.");
		    frm.dienthoai.focus();
		    return false;
	   }
	   	dd=frm.dienthoai.value;
		if(10>dd.length || dd.length>11)
		{
			alert("Số điện thoại không đủ độ dài. Vui lòng nhập lại");
			frm.dienthoai.focus();
			return false;	
		}
		if(frm.email.value=="")
		{
			alert("Bạn chưa nhập email");	
			frm.email.focus();
			return false;
		}
		mail=frm.email.value;
		m=/^([A-z0-9])+[@][a-z]+[.][a-z]+[.]*([a-z]+)*$/;
		if(!m.test(mail))
		{
			alert("Bạn nhập sai email");	
			frm.email.focus();
			return false;
		}
		
		if(frm.pass1.value=="")
		{
			alert("Bạn chưa nhập lại password");	
			frm.pass1.focus();
			return false;
		}
		mk=frm.pass.value;
		mk1=frm.pass1.value;
		if(pass!=pass1)
		{
			alert("Password chưa đúng");	
			frm.pass1.focus();
			return false;
		}
	}
 </script>