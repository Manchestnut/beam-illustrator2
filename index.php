<?php

session_start();
$default_beam_width = 300;
$default_beam_height = 600;
$default_rebar_diameter = 25;
$default_concrete_cover = 30;
$default_stirrup_diameter = 10;
$default_top_bar_qty = 4;
$default_bot_bar_qty = 3;

$_SESSION["beam_width"] = isset($_POST["beam_width"]) ? $_POST["beam_width"] : $default_beam_width;
$beam_width = isset($_SESSION["beam_width"]) ? $_SESSION["beam_width"] : $default_beam_width;

$_SESSION["beam_height"] = isset($_POST["beam_height"]) ? $_POST["beam_height"] : $default_beam_height;
$beam_height = isset($_SESSION["beam_height"]) ? $_SESSION["beam_height"] : $default_beam_height;

$_SESSION["rebar_diameter"] = isset($_POST["rebar_diameter"]) ? $_POST["rebar_diameter"] : $default_rebar_diameter;
$rebar_diameter = isset($_SESSION["rebar_diameter"]) ? $_SESSION["rebar_diameter"] : $default_rebar_diameter;

$_SESSION["concrete_cover"] = isset($_POST["concrete_cover"]) ? $_POST["concrete_cover"] : $default_concrete_cover;
$concrete_cover = isset($_SESSION["concrete_cover"]) ? $_SESSION["concrete_cover"] : $default_concrete_cover;

$_SESSION["stirrup_diameter"] = isset($_POST["stirrup_diameter"]) ? $_POST["stirrup_diameter"] : $default_stirrup_diameter;
$stirrup_diameter = isset($_SESSION["stirrup_diameter"]) ? $_SESSION["stirrup_diameter"] : $default_stirrup_diameter;

$_SESSION["top_bar_qty"] = isset($_POST["top_bar_qty"]) ? $_POST["top_bar_qty"] : $default_top_bar_qty;
$top_bar_qty = isset($_SESSION["top_bar_qty"]) ? $_SESSION["top_bar_qty"] : $default_top_bar_qty;

$_SESSION["bot_bar_qty"] = isset($_POST["bot_bar_qty"]) ? $_POST["bot_bar_qty"] : $default_bot_bar_qty;
$bot_bar_qty = isset($_SESSION["bot_bar_qty"]) ? $_SESSION["bot_bar_qty"] : $default_bot_bar_qty;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/p5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.1.9/addons/p5.sound.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8" />
    <style media="screen">
      .myDiv {
        border: 1px solid black;
        text-align: right;
        width: fit-content;
        padding: 30px;
        position: relative;
        justify-content: center;
        height: fit-content;
        margin: auto;
      }

      body {
        display: flex;
        justify-content: space-evenly;
        flex-direction: row-reverse;
        gap: 200px;
      }
    </style>
  </head>
  <body>
    <div class="myDiv" id="onlyDiv">
      <form method="post" id="onlyForm">
        <label for="beam_width">Beam Width:</label>
        <input
          type="text"
          name="beam_width"
          value="<?php echo $beam_width; ?>"
        /><br />

        <label for="beam_height">Beam Height:</label>
        <input
          type="text"
          name="beam_height"
          value="<?php echo $beam_height; ?>"
        /><br />

        <label for="rebar_diameter">Rebar Diameter:</label>
        <input
          type="text"
          name="rebar_diameter"
          value="<?php echo $rebar_diameter; ?>"
        /><br />

        <label for="concrete_cover">Concrete Cover:</label>
        <input
          type="text"
          name="concrete_cover"
          value="<?php echo $concrete_cover; ?>"
        /><br />

        <label for="stirrup_diameter">Stirrup Diameter:</label>
        <input
          type="text"
          name="stirrup_diameter"
          value="<?php echo $stirrup_diameter; ?>"
        /><br />

        <label for="top_bar_qty">Top Bar Qty:</label>
        <input
          type="text"
          name="top_bar_qty"
          value="<?php echo $top_bar_qty; ?>"
        /><br />

        <label for="bot_bar_qty">Bot Bar Qty:</label>
        <input
          type="text"
          name="bot_bar_qty"
          value="<?php echo $bot_bar_qty; ?>"
        /><br />
        <br />
        <input type="submit" />
        <br />
      </form>
    </div>

    <script>
    // DRAG FUNCTION
    var dragItem = document.querySelector("#onlyDiv");
    var container = document.querySelector("body");

    var active = false;
    var currentX;
    var currentY;
    var initialX;
    var initialY;
    var xOffset = 0;
    var yOffset = 0;

    container.addEventListener("touchstart", dragStart, false);
    container.addEventListener("touchend", dragEnd, false);
    container.addEventListener("touchmove", drag, false);

    container.addEventListener("mousedown", dragStart, false);
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("mousemove", drag, false);

    function dragStart(e) {
      if (e.type === "touchstart") {
        initialX = e.touches[0].clientX - xOffset;
        initialY = e.touches[0].clientY - yOffset;
      } else {
        initialX = e.clientX - xOffset;
        initialY = e.clientY - yOffset;
      }

      if (e.target === dragItem) {
        active = true;
      }
    }

    function dragEnd(e) {
      initialX = currentX;
      initialY = currentY;

      active = false;
    }

    function drag(e) {
      if (active) {
      
        e.preventDefault();
      
        if (e.type === "touchmove") {
          currentX = e.touches[0].clientX - initialX;
          currentY = e.touches[0].clientY - initialY;
        } else {
          currentX = e.clientX - initialX;
          currentY = e.clientY - initialY;
        }

        xOffset = currentX;
        yOffset = currentY;

        setTranslate(currentX, currentY, dragItem);
      }
    }

    function setTranslate(xPos, yPos, el) {
      el.style.transform = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
    }
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
