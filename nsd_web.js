<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
</head>
<body>
    
        <h3 id="heading">Introduction to JavaScript Events</h3>
        <!-- Single, and double click events -->
        <form>
            <input type="button" value="Click Me" onClick="events();">
            <input type="button" value="Double Click" id="btn_click" title="Heading
            text changed.">
        </form>

      
       
        <!-- Mouse events as onMouseOver and onMouseOut -->
        <p id="overMouse" onMouseOver="mouseOver();" onMouseOut="mouseOut();">I
        am mouse over and mouse out event.</p>
       
<!-- Keyboard event as onkeyup -->
<div id="demo_keyboard">
    <form>
        <input type="text" id="keyUpTextBox" placeholder="key up" onkeyup="keyupFunc();">
        <br>
        
    </form>
</div>
<p id="input_TextBox_data"></p>

<!-- Keyboard event as onkeydown -->
<div id="demo_keyboard_down">
    <form>
        <input type="text" id="keyDownTextBox" placeholder="key down" onkeydown="keydownFunc();">
    </form>
</div>
<p id="input_TextBox_keyDown"></p>
       

        <input type="text" id="colortxtbox" onKeyDown="colorDown();" onKeyUp="colorUp();">
        <br><br>
        <form name="myform">
            Blur Event &emsp; <input type="text" id="blurEvent" onBlur="blur_Event();">
            <br /><br />
            
            Focus Event &emsp; <input type="text" id="focusEvent" onFocus="focus_Event();">
            <br /><br />
            On Change Event &emsp; <input type="text" id="onchangeEvent"
        onChange="onChangeEvent();">
            <br /><br />
        
            On Change Event for Drop Down &emsp; <select id="dropdown"
            onChange="dropDownChangeEvent();">
                <option>item 1</option>
                <option>item 2</option>
                <option>item 3</option>
            </select>
            
            <div>
                <p id="dropDownPara">I will change color and font size when you made changes in the above
                drop down list.</p>
            </div>
        
            <input type="text" id="selectText" onSelect="selectTextEvent();">
        </form>
        
    
        

        <script>


            function events()
            {
                alert("I am clicked, event triggered"); 
            }
                    
            // All event types 
            let btn_click = document.getElementById("btn_click");
            let heading_txt = document.getElementById("heading");  
            // Adding event handler
    
            btn_click.addEventListener("dblclick", ()=>{
    
                    heading_txt.innerText = "I am changed"; 
                }); 
            
    
            function mouseOver() {
                document.getElementById("overMouse").style.color = "blue";
            }
    
            function mouseOut(){
                document.getElementById("overMouse").style.color = "yellow"; 
            }
    
            function keyupFunc() {
            let data = document.getElementById("keyUpTextBox").value;
            document.getElementById("input_TextBox_data").innerText = "KeyUp Input: " + data;
        }
    
        function keydownFunc() {
            let data = document.getElementById("keyDownTextBox").value;
            document.getElementById("input_TextBox_keyDown").innerText = "KeyDown Input: " + data;
        }
    
        // KeyDown event: change text color to red
        function colorDown() {
            document.getElementById("colortxtbox").style.color = "red";
        }
    
        // KeyUp event: change text color to green
        function colorUp() {
            document.getElementById("colortxtbox").style.color = "green";
        }
    
        // Blur event: change background to lightgray
        function blur_Event() {
            document.getElementById("blurEvent").style.backgroundColor = "lightgray";
        }
    
        // Focus event: change background to lightyellow
        function focus_Event() {
            document.getElementById("focusEvent").style.backgroundColor = "lightyellow";
        }
    
        // Change event for text input
        function onChangeEvent() {
            alert("Text input changed: " + document.getElementById("onchangeEvent").value);
        }
    
        // Change event for dropdown
        function dropDownChangeEvent() {
            const para = document.getElementById("dropDownPara");
            para.style.color = "blue";
            para.style.fontSize = "20px";
        }
    
        // Select event
        function selectTextEvent() {
            document.getElementById("selectTextarea").innerText = "You selected some text!";
        }
    
        </script>
</body>
</html>


