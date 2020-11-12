<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/addons/p5.sound.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8" />
  </head>
  <body>
    <form action = "illustrate_beam.php" method = "post">
      <table style="border: 0px">
        <tr style="background: #cccccc;">
          <td id="parameter" >Parameter</td>
          <td id="value" >Value</td>
        </tr>
        <tr>
          <td style="text-align: left;">Beam Width:</td>
          <td><input type="text" name="beam_width" size="4" maxlength="3" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Beam Height:</td>
          <td><input type="text" name="beam_height" size="4" maxlength="4" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Rebar Diameter:</td>
          <td><input type="text" name="rebar_diameter" size="4" maxlength="2" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Concrete Cover:</td>
          <td><input type="text" name="concrete_cover" size="4" maxlength="2" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Stirrup Diameter:</td>
          <td><input type="text" name="stirrup_diameter" size="4" maxlength="2" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Top Bar Quantity:</td>
          <td><input type="text" name="top_bar_qty" size="4" maxlength="1" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Bot Bar Quantity:</td>
          <td><input type="text" name="bot_bar_qty" size="4" maxlength="1" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><input type="submit" value="Illustrate Beam"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><a href="beam_form.html">Reset</a></td>
        </tr>
      </table>
</form>
  </body>
</html>
