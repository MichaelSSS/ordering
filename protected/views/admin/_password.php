<script>
    $(document).ready(function () {
        $('#User_password').tooltip();

        $('.show_pass').click(function(){
            element =  $('#User_password');
            element.replaceWith(element.clone().attr('type',(element.attr('type') == 'password') ? 'text' : 'password'))
        })
        $('.show_pass').on('click',(function(){
            element =  $('#User_confirmPassword');
            element.replaceWith(element.clone().attr('type',(element.attr('type') == 'password') ? 'text' : 'password'))
            element.val() == 'Show Password' ? 'rf4r':'f4rf'
            return false;
        }))
        $('.generate_pass').click(function(){
            var pass = '';
            var lowLetter = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
            var highLetter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            var number = [1,2,3,4,5,6,7,8,9,0];
            var spChar = ['!','@','#','$','%','^','&','*','(',')','_','-','+','=','~','/',';',':','<','>','?'];

            for(i=0;i<2;i++){
                pass += lowLetter[parseInt(Math.random()*lowLetter.length)]
                pass += highLetter[parseInt(Math.random()*highLetter.length)]
                pass += number[parseInt(Math.random()*number.length)]
                pass += spChar[parseInt(Math.random()*spChar.length)]
            }

            pass = pass.split('')

            function shuffle( b )
            {
                var i = this.length, j, t;
                while( i )
                {
                    j = Math.floor( ( i-- ) * Math.random() );
                    t = b && typeof this[i].shuffle!=='undefined' ? this[i].shuffle() : this[i];
                    this[i] = this[j];
                    this[j] = t;
                }

                return this;
            };
            shuffle(pass);
            pass = pass.join('');

            $('#User_password').val(pass);
            $('#User_confirmPassword').val(pass);
            return false;
        })

    });
</script>