<html xmlns="http://www.w3.org/1999/xhtml">

<head runat="server">

    <title>Blink Text using JavaScript</title></style>

    <script language="javascript">

        setInterval(blinktext, 500);

        var txt = "";

        var count = 0;

        function blinktext() {

            var cntrl = document.getElementById("txtblinkingtext");

            if (count == 0)

                txt = cntrl.value;

            if (count % 2 == 0)

                cntrl.value = "";

            else

                cntrl.value = txt;

            count++;

        }

    </script>

</head>

<body>

    <input type="text" id="txtblinkingtext" name="txtblinkingtext" value="Blinking Text"

            readonly="readonly" style="height: 20px; width: 100px; 

            color: black; border: 0px none; text-align: center;">

    

    

</body>

</html>