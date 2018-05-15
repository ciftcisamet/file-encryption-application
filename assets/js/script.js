$(function(){

	var body = $('body'),
		stage = $('#stage'),
		back = $('a.back');

	$('#step1 .encrypt').click(function(){
		body.attr('class', 'encrypt');

		step(2);
	});

	$('#step1 .decrypt').click(function(){
		body.attr('class', 'decrypt');
		step(2);
	});

	$('#step2 .button').click(function(){
		$(this).parent().find('input').click();
	});



	var file = null;

	$('#step2').on('change', '#encrypt-input', function(e){


		if(e.target.files.length!=1){
			alert('Sifrelenecek dosyayı seçin!');
			return false;
		}

		file = e.target.files[0];

		/* DOSYA BOYUTUNU SINIRLADIK */

		if(file.size > 1024*1024){
			alert('Lütfen 1 mbdan daha küçük bir dosya seçin!');
			return;
		}

		step(3);
	});

	$('#step2').on('change', '#decrypt-input', function(e){

		if(e.target.files.length!=1){
			alert('Lütfen şifresi çözülecek dosyayı seçin!');
			return false;
		}

		file = e.target.files[0];
		step(3);
	});




	$('a.button.process').click(function(){

		var input = $(this).parent().find('input[type=password]'),
			a = $('#step4 a.download'),
			password = input.val();

		input.val('');

		if(password.length<5){
			alert('Daha uzun bir şifre girin!');
			return;
		}

		var reader = new FileReader();

		if(body.hasClass('encrypt')){


			reader.onload = function(e){



				var encrypted = CryptoJS.AES.encrypt(e.target.result, password);

				/* RASTGELE YENİDEN İSİMLENDİRDİK */

				function uniqueID(){
			  function chr4(){
			    return Math.random().toString(16).slice(-4);
			  }
			  return chr4() + chr4() +
			    '-' + chr4() +
			    '-' + chr4() +
			    '-' + chr4() +
			    '-' + chr4() + chr4() + chr4();
			}

				a.attr('href', 'data:application/octet-stream,' + encrypted);
				a.attr('download', uniqueID() + '.encrypted');


				step(4);
			};

			reader.readAsDataURL(file);

			$('a.button.upload').click(function(){

			var url = document.getElementById("download").href;
			document.getElementById("buton").value = url;

			var name = document.getElementById("download").download;
			document.getElementById("buton2").value = name;

			$('input.gonder').click();

			});

		}
		else {


			reader.onload = function(e){

				var decrypted = CryptoJS.AES.decrypt(e.target.result, password)
										.toString(CryptoJS.enc.Latin1);

				if(!/^data:/.test(decrypted)){
					alert("Hatalı şifre ya da dosya! Lütfen tekrar deneyin...");
					return false;
				}

				a.attr('href', decrypted);
				a.attr('download', file.name.replace('.encrypted',''));

				step(4);
			};

			reader.readAsText(file);

			$('a.button.upload').hide();

		}
	});

	back.click(function(){

		$('#step2 input[type=file]').replaceWith(function(){
			return $(this).clone();
		});

		step(1);
	});

	function step(i){

		if(i == 1){
			back.fadeOut();
		}
		else{
			back.fadeIn();
		}

		stage.css('top',(-(i-1)*100)+'%');
	}

});
