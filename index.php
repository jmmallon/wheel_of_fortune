<?php
session_start();

$storycount = 8;

$stories = file("stories.txt");
shuffle($stories);

$colors = Array(
/*
'#999900',
'#00ff00',
'#6aa84f',
'#cc0000',
'#b4a7d6',
'#ff00ff',
'#99ff99',
'#ff0066',
*/

'#eae56f',
'#89f26e',
'#7de6ef',
'#e7706f',
'#0099ff',
'#298f6e',
'#ffcc66',
'#e770f6'
);
shuffle($colors);

function fix ($string) {
	return addslashes(rtrim($string));
}

?>

<!--
    Winhweel.js basic code wheel example by Douglas McKechie @ www.dougtesting.net
    See website for tutorials and other documentation.

    The MIT License (MIT)

    Copyright (c) 2016 Douglas McKechie

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
-->
<html>
    <head>
        <title>Strange Travel Suggestions</title>
        <link rel="stylesheet" href="main.css" type="text/css" />
        <script type="text/javascript" src="Winwheel.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    </head>
    <body>
        <div align="center">
            <h1>Welcome to Strange Travel Suggestions</h1>
            <p>Spin the wheel and hear a tale!</p>
            <br />
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td align="center" valign="center">
	    <div class="arrow-top" onclick="location.reload()"></div>
            <canvas id="canvas" width="700" height="700" data-responsiveMinWidth="180" data-responsiveScaleHeight="true" onClick="startSpin();">
                <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try another.</p>
            </canvas>
                    </td>
                </tr>
            </table>
        </div>
        <script>
            // Create winwheel as per normal.
            let theWheel = new Winwheel({
                'numSegments'  : <?php print $storycount; ?>,     // Specify number of segments.
                'textFontSize' : 28,    // Set font size as desired.
                'responsive'   : true,  // This wheel is responsive!
                'segments'     :        // Define segments including colour and text.
                [
<?php
for ($i = 0; $i < $storycount; $i++) {
	print "{'fillStyle' : '" . $colors[$i] . "', 'text' : '" . fix($stories[$i]) . "'},\n";
}
?>
		    /*
                    {'fillStyle' : '#89f26e', 'text' : '<?php print fix($stories[1]); ?>'},
                    {'fillStyle' : '#7de6ef', 'text' : '<?php print fix($stories[2]); ?>'},
                    {'fillStyle' : '#e7706f', 'text' : '<?php print fix($stories[3]); ?>'},
                    {'fillStyle' : '#0099ff', 'text' : '<?php print fix($stories[4]); ?>'},
                    {'fillStyle' : '#298f6e', 'text' : '<?php print fix($stories[5]); ?>'},
                    {'fillStyle' : '#ffcc66', 'text' : '<?php print fix($stories[6]); ?>'},
                    {'fillStyle' : '#e770f6', 'text' : '<?php print fix($stories[7]); ?>'},
		    */
                ],
                'animation' :           // Specify the animation to use.
                {
                    'type'     : 'spinToStop',
                    'duration' : 5,     // Duration in seconds.
                    'spins'    : 8,     // Number of complete spins.
                    'callbackSound'    : playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger'     : 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
                'pins' :				// Turn pins on.
                {
                    'number'     : 24,
                    'fillStyle'  : 'silver',
                    'outerRadius': 6,
                    'responsive' : true, // This must be set to true if pin size is to be responsive, if not just location is.
                }
            });

            // Loads the tick audio sound in to an audio object.
            let audio = new Audio('tick.mp3');

            // This function is called when the sound is to be played.
            function playSound()
            {
                // Stop and rewind the sound if it already happens to be playing.
                audio.pause();
                audio.currentTime = 0;

                // Play the sound.
                audio.play();
            }

            // -----------------------------------------------------------------
            // Called by the onClick of the canvas, starts the spinning.
            function startSpin()
            {
                // Stop any current animation.
                theWheel.stopAnimation(false);

                // Reset the rotation angle to less than or equal to 360 so spinning again
                // works as expected. Setting to modulus (%) 360 keeps the current position.
                theWheel.rotationAngle = theWheel.rotationAngle % 360;

                // Start animation.
                theWheel.startAnimation();
            }
        </script>
    </body>
</html>
