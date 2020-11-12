<?php

session_start();
$_SESSION["beam_width"] = $_POST["beam_width"];
$_SESSION["beam_height"] = $_POST["beam_height"];
$_SESSION["rebar_diameter"] = $_POST["rebar_diameter"];
$_SESSION["concrete_cover"] = $_POST["concrete_cover"];
$_SESSION["stirrup_diameter"] = $_POST["stirrup_diameter"];
$_SESSION["top_bar_qty"] = $_POST["top_bar_qty"];
$_SESSION["bot_bar_qty"] = $_POST["bot_bar_qty"];

$beam_width = $_SESSION["beam_width"];
$beam_height = $_SESSION["beam_height"];
$rebar_diameter = $_SESSION["rebar_diameter"];
$concrete_cover = $_SESSION["concrete_cover"];
$stirrup_diameter = $_SESSION["stirrup_diameter"];
$top_bar_qty = $_SESSION["top_bar_qty"];
$bot_bar_qty = $_SESSION["bot_bar_qty"];

?>

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
      <table style="border: 0px;">
        <tr style="background: #cccccc;">
          <td style="width: 150px; text-align: center; font-weight: bold;">Parameter</td>
          <td style="width: 70px; text-align: center; font-weight: bold;">Value</td>
        </tr>
        <tr>
          <td style="text-align: left;">Beam Width:</td>
          <td><input type="text" name="beam_width" size="4" maxlength="3" value="<?php echo $beam_width; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Beam Height:</td>
          <td><input type="text" name="beam_height" size="4" maxlength="4" value="<?php echo $beam_height; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Rebar Diameter:</td>
          <td><input type="text" name="rebar_diameter" size="4" maxlength="2" value="<?php echo $rebar_diameter; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Concrete Cover:</td>
          <td><input type="text" name="concrete_cover" size="4" maxlength="2" value="<?php echo $concrete_cover; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Stirrup Diameter:</td>
          <td><input type="text" name="stirrup_diameter" size="4" maxlength="2" value="<?php echo $stirrup_diameter; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Top Bar Quantity:</td>
          <td><input type="text" name="top_bar_qty" size="4" maxlength="1" value="<?php echo $top_bar_qty; ?>" /></td>
        </tr>
        <tr>
          <td style="text-align: left;">Bot Bar Quantity:</td>
          <td><input type="text" name="bot_bar_qty" size="4" maxlength="1" value="<?php echo $bot_bar_qty; ?>" /></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><input type="submit" value="Illustrate Beam"></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: center;"><a href="beam_form.html">Reset</a></td>
        </tr>
      </table>
    </form>

    <script>
    // VARIABLES
    var beam_width = <?php echo $beam_width; ?>;
    var beam_height = <?php echo $beam_height; ?>;
    var concrete_cover = <?php echo $concrete_cover; ?>;
    var rebar_diameter = <?php echo $rebar_diameter; ?>;
    var stirrup_diameter = <?php echo $stirrup_diameter; ?>;
    var top_bar_qty = <?php echo $top_bar_qty; ?>;
    var bot_bar_qty = <?php echo $bot_bar_qty; ?>;

    var margin = 200;
    var dim_text_size = 20;
    var dim_text_font = "Arial";
    var dim_tick_length = 10;
    var set_dim_offset = 2;
    var set_dim_text_offset = 10;
    var set_inner_dim_offset = 35;


    // CONSTANTS
    const beam_center_x = beam_width / 2;
    const beam_center_y = beam_height / 2;
    const stirrup_width = beam_width - (concrete_cover + concrete_cover);
    const stirrup_height = beam_height - (concrete_cover + concrete_cover);
    const stirrup_width_inner = beam_width - (concrete_cover + concrete_cover + stirrup_diameter + stirrup_diameter);
    const stirrup_height_inner = beam_height - (concrete_cover + concrete_cover + stirrup_diameter + stirrup_diameter);
    const rebar_radius = rebar_diameter / 2;
    const rebar_origin_location = concrete_cover + rebar_radius + stirrup_diameter + margin;
    const rebar_width = stirrup_width_inner - rebar_diameter;
    const top_bar_spacing = rebar_width / (top_bar_qty - 1);
    const bot_bar_spacing = rebar_width / (bot_bar_qty - 1);

    const canvas_width = beam_width + (margin * 2);
    const canvas_height = beam_height + (margin * 2);
    const canvas_center_x = canvas_width / 2;
    const canvas_center_y = canvas_height / 2;

    const dim_offset = margin / set_dim_offset;
    const dim_text_offset = dim_offset - set_dim_text_offset;


    // FUNCTIONS
    function setup() {
      createCanvas(canvas_width, canvas_height);
      background('white');
      angleMode(DEGREES);
      textFont(dim_text_font);
    }

    // 1. Draw beam outline first.
    function draw_beam_outline() {
      rectMode(CENTER);
      rect(canvas_center_x,
           canvas_center_y,
           beam_width,
           beam_height);
    }

    // 2. Draw stirrup's outer edge.
    function draw_stirrup_out_edge() {
      rectMode(CENTER);
      rect(canvas_center_x,
           canvas_center_y,
           stirrup_width,
           stirrup_height);
    }

    // 3. Draw stirrup's inner edge.
    function draw_stirrup_inner_edge() {
      rectMode(CENTER);
      rect(canvas_center_x,
           canvas_center_y,
           stirrup_width_inner,
           stirrup_height_inner);
    }

    // 4. Draw top bars.
    function draw_top_bars() {
      for(i = 0; i <= rebar_width; i += top_bar_spacing) {
        circle(rebar_origin_location + i,
               rebar_origin_location,
               rebar_diameter);
      }
    }

    // 5. Draw bottom bars.
    function draw_bot_bars() {
      for(i = 0; i <= rebar_width; i += bot_bar_spacing) {
        circle(rebar_origin_location + i,
               rebar_origin_location + stirrup_height_inner - rebar_diameter,
               rebar_diameter);
      }

    }

    // 6. Draw horizontal dimension.
    function draw_hor_dimension() {
      // DIM HORIZONTAL
      line(
        margin - dim_tick_length,
        dim_offset,
        beam_width + margin + dim_tick_length,
        dim_offset);

      translate(0,set_inner_dim_offset);
      line(
        margin - dim_tick_length,
        dim_offset,
        beam_width + margin + dim_tick_length,
        dim_offset);
      translate(0,-set_inner_dim_offset);

      line(
        margin,
        margin,
        margin,
        dim_offset - dim_tick_length);

      translate(concrete_cover, 0);
      line(
        margin,
        margin,
        margin,
        dim_offset + set_inner_dim_offset - dim_tick_length);
      translate(-concrete_cover, 0);

      translate(concrete_cover + stirrup_width, 0);
      line(
        margin,
        margin,
        margin,
        dim_offset + set_inner_dim_offset - dim_tick_length);
      translate(-(concrete_cover + stirrup_width), 0);

      line(
        margin+beam_width,
        margin+beam_width,
        margin+beam_width,
        dim_offset - dim_tick_length);

      textAlign(CENTER,CENTER);
      textSize(dim_text_size);
      text(beam_width, canvas_center_x, dim_text_offset);

      translate(0,set_inner_dim_offset);
      textAlign(CENTER,CENTER);
      textSize(dim_text_size);
      text(stirrup_width, canvas_center_x, dim_text_offset);
      translate(0,-set_inner_dim_offset);
    }

    function draw_ver_dimension() {
      // DIM VERTICAL
      line(
        dim_offset,
        margin - dim_tick_length,
        dim_offset,
        beam_height + margin + dim_tick_length);

      translate(set_inner_dim_offset,0);
      line(
        dim_offset,
        margin - dim_tick_length,
        dim_offset,
        beam_height + margin + dim_tick_length);
      translate(-set_inner_dim_offset,0);

      line(
        margin,
        margin,
        dim_offset - dim_tick_length,
        margin);

      translate(0, concrete_cover);
      line(
        margin,
        margin,
        dim_offset + set_inner_dim_offset - dim_tick_length,
        margin);
      translate(0, - concrete_cover);

      translate(0, concrete_cover + stirrup_height);
      line(
        margin,
        margin,
        dim_offset + set_inner_dim_offset - dim_tick_length,
        margin);
      translate(0, - (concrete_cover + stirrup_height));

      line(
        margin,
        margin+beam_height,
        dim_offset - dim_tick_length,
        margin+beam_height);

      textAlign(CENTER,CENTER);
      textSize(dim_text_size);
      translate(dim_text_offset, canvas_center_y);
      rotate(-90);
      text(beam_height, 0, 0);
      rotate(90);
      translate(-dim_text_offset, -canvas_center_y);

      translate(set_inner_dim_offset,0);
      textAlign(CENTER,CENTER);
      textSize(dim_text_size);
      translate(dim_text_offset, canvas_center_y);
      rotate(-90);
      text(stirrup_height, 0, 0);
      rotate(90);
      translate(-dim_text_offset, -canvas_center_y);
      translate(-set_inner_dim_offset,0);

    }

    // MAIN FUNCTION
    function draw() {
      strokeWeight(3);
      draw_beam_outline();
      strokeWeight(1);
      draw_stirrup_out_edge();
      draw_stirrup_inner_edge();
      draw_top_bars();
      draw_bot_bars();
      draw_hor_dimension();
      draw_ver_dimension();
    }
    </script>
  </body>
</html>
