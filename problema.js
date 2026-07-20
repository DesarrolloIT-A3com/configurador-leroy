// RECALCULAMOS EL PRECIO CON LOS EXTRAS
function recalcular_precio() {
  var tarifa = $("#tarifa").val();
  var descuento = $("#descuento").val();
  var serie = $("#serie_marcada").val();
  var num_puertas = $("#puertas_marcado").val();
  var precio_frente = $("#precio_frente").val();
  var cant_inc_desc_frente = $("#cant_inc_desc_frente").val();
  var precio_ceramica = $("#precio_ceramica").val();
  var precio_modulos_interior = $("#precio_modulos_interior").val();
  var precio_accesorios_interior = $("#precio_accesorios_interior").val();
  var cant_inc_desc_interior = $("#cant_inc_desc_interior").val();
  var tapetas = $("#tapetas_seleccionado").val();
  var laterales = $("#laterales_seleccionado").val();
  var costados = $("#costados_seleccionado").val();
  var costados_dist = $("#costados_dist").val();
  var fijos = $("#fijos_seleccionado").val();
  var fijos_dist = $("#fijos_dist").val();
  var montaje_frente = $("#montaje_frente_seleccionado").val();
  var montaje_frente_dist = $("#montaje_frente_dist").val();
  var montaje_frente_arjomy = $("#montaje_frente_arjomy_seleccionado").val();
  var montaje_interior = $("#montaje_interior_seleccionado").val();
  var montaje_interior_dist = $("#montaje_interior_dist").val();
  var montaje_interior_arjomy = $(
    "#montaje_interior_arjomy_seleccionado"
  ).val();
  var desmontaje_frente = $("#desmontaje_frente_seleccionado").val();
  var desmontaje_frente_dist = $("#desmontajes_frentes_dist").val();
  var desmontaje_frente_arjomy = $(
    "#desmontaje_frente_arjomy_seleccionado"
  ).val();
  var desmontaje_interior = $("#desmontaje_interior_seleccionado").val();
  var desmontaje_interior_dist = $("#desmontajes_interiores_dist").val();
  var desmontaje_interior_arjomy = $(
    "#desmontaje_interior_arjomy_seleccionado"
  ).val();
  var medidas_ancho = $("#medidas_ancho").val();
  var juego_led = $("#juego_led_seleccionado").val();
  var juego_led_dist = $("#juego_led_dist").val();
  var juego_led_arjomy = $("#juego_led_arjomy_seleccionado").val();
  var rematar_frente = $("#rematar_frente_seleccionado").val();
  var rematar_frente_dist = $("#rematar_frente_dist").val();
  var rematar_frente_arjomy = $("#rematar_frente_arjomy_seleccionado").val();
  var rematar_interior = $("#rematar_interior_seleccionado").val();
  var sistema_frenos = $("#sistema_frenos_seleccionado").val();
  var sistema_frenos_dist = $("#sistema_frenos_dist").val();
  var regleta_led = $("#regleta_led_seleccionado").val();
  var frente_abuardillado = $("#frente_abuardillado_seleccionado").val();
  var albanileria_con = $("#albanileria_con_seleccionado").val();
  var albanileria_sin = $("#albanileria_sin_seleccionado").val();
  var km_medicion = $("#km_medicion").val();
  var km_montaje = $("#km_montaje").val();
  var extras_1 = $("#extras_1_seleccionado").val();
  var extras_2 = $("#extras_2_seleccionado").val();
  var extras_3 = $("#extras_3_seleccionado").val();
  var extras_4 = $("#extras_4_seleccionado").val();
  var extras_5 = $("#extras_5_seleccionado").val();
  var extras_6 = $("#extras_6_seleccionado").val();
  var extras_7 = $("#extras_7_seleccionado").val();
  var extras_8 = $("#extras_8_seleccionado").val();
  var extras_9 = $("#extras_9_seleccionado").val();
  var extras_10 = $("#extras_10_seleccionado").val();
  var extras_11 = $("#extras_11_seleccionado").val();
  var extras_12 = $("#extras_12_seleccionado").val();
  var extras_13 = $("#extras_13_seleccionado").val();
  var albanileria_sencilla = $("#albanileria_sencilla_seleccionado").val();
  var albanileria_tirar_tabique = $(
    "#albanileria_tirar_tabique_seleccionado"
  ).val();
  var albanileria_quitar_solera = $(
    "#albanileria_quitar_solera_seleccionado"
  ).val();
  var albanileria_mover_enchufe = $(
    "#albanileria_mover_enchufe_seleccionado"
  ).val();
  var albanileria_costado_pladur = $(
    "#albanileria_costado_pladur_seleccionado"
  ).val();
  
  $.post(
    "index.php",
    {
      seccion: "ajax",
      sub: "nuevo_proyecto",
      ac: "recalcular_precio",
      medidas_ancho: medidas_ancho,
      tarifa: tarifa,
      descuento: descuento,
      serie: serie,
      num_puertas: num_puertas,
      precio_frente: precio_frente,
      cant_inc_desc_frente: cant_inc_desc_frente,
      precio_ceramica: precio_ceramica,
      precio_modulos_interior: precio_modulos_interior,
      precio_accesorios_interior: precio_accesorios_interior,
      cant_inc_desc_interior: cant_inc_desc_interior,
      tapetas: tapetas,
      laterales: laterales,
      costados: costados,
      fijos: fijos,
      montaje_frente: montaje_frente,
      montaje_interior: montaje_interior,
      desmontaje_frente: desmontaje_frente,
      desmontaje_interior: desmontaje_interior,
      desmontaje_interior_arjomy: desmontaje_interior_arjomy,
      juego_led: juego_led,
      rematar_frente: rematar_frente,
      rematar_interior: rematar_interior,
      sistema_frenos: sistema_frenos,
      costados_dist: costados_dist,
      fijos_dist: fijos_dist,
      montaje_frente_dist: montaje_frente_dist,
      montaje_frente_arjomy: montaje_frente_arjomy,
      montaje_interior_dist: montaje_interior_dist,
      montaje_interior_arjomy: montaje_interior_arjomy,
      desmontaje_frente_dist: desmontaje_frente_dist,
      desmontaje_frente_arjomy: desmontaje_frente_arjomy,
      desmontaje_interior_dist: desmontaje_interior_dist,
      juego_led_dist: juego_led_dist,
      juego_led_arjomy: juego_led_arjomy,
      rematar_frente_dist: rematar_frente_dist,
      rematar_frente_arjomy: rematar_frente_arjomy,
      sistema_frenos_dist: sistema_frenos_dist,
      regleta_led: regleta_led,
      frente_abuardillado: frente_abuardillado,
      albanileria_con: albanileria_con,
      albanileria_sin: albanileria_sin,
      km_medicion: km_medicion,
      km_montaje: km_montaje,
      extras_1: extras_1,
      extras_2: extras_2,
      extras_3: extras_3,
      extras_4: extras_4,
      extras_5: extras_5,
      extras_6: extras_6,
      extras_7: extras_7,
      extras_8: extras_8,
      extras_9: extras_9,
      extras_10: extras_10,
      extras_11: extras_11,
      extras_12: extras_12,
      extras_13: extras_13,
      albanileria_sencilla: albanileria_sencilla,
      albanileria_tirar_tabique: albanileria_tirar_tabique,
      albanileria_quitar_solera: albanileria_quitar_solera,
      albanileria_mover_enchufe: albanileria_mover_enchufe,
      albanileria_costado_pladur: albanileria_costado_pladur,
    },
    function (data) {

      $(".txt_resumen.precio").html(
        '<div class="precio_frente">Precio frente: <span>' +
          data.precio_frente +
          "€</span></div>"
      );

      if (data.cant_incremento_descuento != 0) {
        $(".txt_resumen.precio .precio_frente").after(
          '<div class="inc_desc_frente">' +
            $("#inc_desc_frente").val() +
            ": <span>" +
            data.cant_incremento_descuento +
            "€</span></div>"
        );
      } else {
        $(".txt_resumen.precio .precio_frente").after(
          '<div class="inc_desc_frente"></div>'
        );
      }

      if (data.precio_modulos_interior > 0) {
        $(".txt_resumen.precio .inc_desc_frente").after(
          '<div class="precio_modulos_interior">Precio interior: <span>' +
            data.precio_modulos_interior +
            "€</span></div>"
        );
        $("#precio_modulos_interior").val(data.precio_modulos_interior);
      } else {
        $(".txt_resumen.precio .inc_desc_frente").after(
          '<div class="precio_modulos_interior"></div>'
        );
      }

      if (data.cant_incremento_descuento_interior != 0) {
        $(".txt_resumen.precio .precio_modulos_interior").after(
          '<div class="inc_desc_interior">' +
            $("#inc_desc_interior").val() +
            ": <span>" +
            data.cant_incremento_descuento_interior +
            "€</span></div>"
        );
      } else {
        $(".txt_resumen.precio .precio_modulos_interior").after(
          '<div class="inc_desc_interior"></div>'
        );
      }

      if (data.precio_accesorios_interior > 0) {
        $(".txt_resumen.precio .inc_desc_interior").after(
          '<div class="precio_accesorios_interior">Precio accesorios: <span>' +
            data.precio_accesorios_interior +
            "€</span></div>"
        );
        $("#precio_accesorios_interior").val(data.precio_accesorios_interior);
      } else {
        $(".txt_resumen.precio .inc_desc_interior").after(
          '<div class="precio_accesorios_interior"></div>'
        );
      }

      if (data.precio_sistema_frenos > 0) {
        $(".txt_resumen.precio .precio_accesorios_interior").after(
          '<div class="precio_sistema_frenos">Precio sistema frenos: <span>' +
            data.precio_sistema_frenos +
            "€</span></div>"
        );
        $("#precio_sistema_frenos").val(data.precio_sistema_frenos);
      } else {
        $(".txt_resumen.precio .precio_accesorios_interior").after(
          '<div class="precio_sistema_frenos"></div>'
        );
        $("#precio_sistema_frenos").val(0);
        $("#precio_sistema_frenos_dist").val(0);
      }

      if (data.precio_regleta_led > 0) {
        $(".txt_resumen.precio .precio_sistema_frenos").after(
          '<div class="precio_regleta_led">Precio regletas led: <span>' +
            data.precio_regleta_led +
            "€</span></div>"
        );
        $("#precio_regleta_led").val(data.precio_regleta_led);
      } else {
        $(".txt_resumen.precio .precio_sistema_frenos").after(
          '<div class="precio_regleta_led"></div>'
        );
        $("#precio_regleta_led").val(0);
      }

      if (data.precio_frente_abuardillado > 0) {
        $(".txt_resumen.precio .precio_regleta_led").after(
          '<div class="precio_frente_abuardillado">Precio frente abuardillado: <span>' +
            data.precio_frente_abuardillado +
            "€</span></div>"
        );
        $("#precio_frente_abuardillado").val(data.precio_frente_abuardillado);
      } else {
        $(".txt_resumen.precio .precio_regleta_led").after(
          '<div class="precio_frente_abuardillado"></div>'
        );
        $("#precio_frente_abuardillado").val(0);
      }

      if (data.precio_costados > 0) {
        $(".txt_resumen.precio .precio_frente_abuardillado").after(
          '<div class="precio_costados">Precio costados: <span>' +
            data.precio_costados +
            "€</span></div>"
        );
        $("#precio_costados").val(data.precio_costados);
      } else {
        $(".txt_resumen.precio .precio_frente_abuardillado").after(
          '<div class="precio_costados"></div>'
        );
        $("#precio_costados").val(0);
        $("#precio_costados_dist").val(0);
      }

      if (data.precio_fijos > 0) {
        $(".txt_resumen.precio .precio_costados").after(
          '<div class="precio_fijos">Precio fijos: <span>' +
            data.precio_fijos +
            "€</span></div>"
        );
        $("#precio_fijos").val(data.precio_fijos);
      } else {
        $(".txt_resumen.precio .precio_costados").after(
          '<div class="precio_fijos"></div>'
        );
        $("#precio_fijos").val(0);
        $("#precio_fijos_dist").val(0);
      }

      if ($("#rematar_frente").is(":checked")) {
        $(".txt_resumen.precio .precio_fijos").after(
          '<div class="precio_rematar_frente">Precio rematar frente: <span>' +
            data.precio_rematar_frente +
            "€</span></div>"
        );
        $("#precio_rematar_frente").val(data.precio_rematar_frente);
      } else {
        $(".txt_resumen.precio .precio_fijos").after(
          '<div class="precio_rematar_frente"></div>'
        );
        $("#precio_rematar_frente").val(0);
        $("#precio_rematar_frente_dist").val(0);
      }

      if ($("#juego_led").is(":checked")) {
        $(".txt_resumen.precio .precio_rematar_frente").after(
          '<div class="precio_juego_led">Precio juego led: <span>' +
            data.precio_juego_led +
            "€</span></div>"
        );
        $("#precio_juego_led").val(data.precio_juego_led);
      } else {
        $(".txt_resumen.precio .precio_rematar_frente").after(
          '<div class="precio_juego_led"></div>'
        );
        $("#precio_juego_led").val(0);
        $("#precio_juego_led_dist").val(0);
      }

      if ($("#rematar_interior").is(":checked")) {
        $(".txt_resumen.precio .precio_juego_led").after(
          '<div class="precio_rematar_interior">Precio rematar interior: <span>' +
            data.precio_rematar_interior +
            "€</span></div>"
        );
        $("#precio_rematar_interior").val(data.precio_rematar_interior);
      } else {
        $(".txt_resumen.precio .precio_juego_led").after(
          '<div class="precio_rematar_interior"></div>'
        );
        $("#precio_rematar_interior").val(0);
      }

      $(".txt_resumen.precio .precio_rematar_interior").after(
        '<div class="precio_montaje">Precio montaje: <span>' +
          data.precio_montaje +
          "€</span></div>"
      );
      $("#precio_montaje_frente").val(data.precio_montaje);

      if (
        ($("#desmontajes_frentes_1").is(":checked") ||
          $("#desmontajes_frentes_2").is(":checked") ||
          $("#desmontajes_frentes_3").is(":checked") ||
          $("#desmontajes_frentes_4").is(":checked")) &&
        ($("#desmontajes_interiores_1").is(":checked") ||
          $("#desmontajes_interiores_2").is(":checked") ||
          $("#desmontajes_interiores_3").is(":checked") ||
          $("#desmontajes_interiores_4").is(":checked"))
      ) {
        $(".txt_resumen.precio .precio_montaje").after(
          '<div class="precio_desmontaje">Precio desmontaje: <span>' +
            data.precio_desmontaje +
            "€</span></div>"
        );
        $("#precio_desmontaje").val(data.precio_desmontaje);
      } else {
        if (
          $("#desmontajes_frentes_1").is(":checked") ||
          $("#desmontajes_frentes_2").is(":checked") ||
          $("#desmontajes_frentes_3").is(":checked") ||
          $("#desmontajes_frentes_4").is(":checked")
        ) {
          $(".txt_resumen.precio .precio_montaje").after(
            '<div class="precio_desmontaje_frente">Precio desmontaje frente: <span>' +
              data.precio_desmontaje_frente +
              "€</span></div>"
          );
          $("#precio_desmontaje_frente").val(data.precio_desmontaje_frente);
        } else {
          $(".txt_resumen.precio .precio_montaje").after(
            '<div class="precio_desmontaje_frente"></div>'
          );
          $("#precio_desmontaje_frente").val(0);
          $("#precio_desmontaje_frente_dist").val(0);
        }

        if (
          $("#desmontajes_interiores_1").is(":checked") ||
          $("#desmontajes_interiores_2").is(":checked") ||
          $("#desmontajes_interiores_3").is(":checked") ||
          $("#desmontajes_interiores_4").is(":checked")
        ) {
          $(".txt_resumen.precio .precio_desmontaje_frente").after(
            '<div class="precio_desmontaje_interior">Precio desmontaje interior: <span>' +
              data.precio_desmontaje_interior +
              "€</span></div>"
          );
          $("#precio_desmontaje_interior").val(data.precio_desmontaje_interior);
          $("#precio_desmontaje_interior_dist").val(
            data.precio_desmontaje_interior_dist
          );
        } else {
          $(".txt_resumen.precio .precio_desmontaje_frente").after(
            '<div class="precio_desmontaje_interior"></div>'
          );
          $("#precio_desmontaje_interior").val(0);
          $("#precio_desmontaje_interior_dist").val(0);
        }
      }

      if (data.precio_albanileria_con > 0) {
        $(".txt_resumen.precio .precio_desmontaje_interior").after(
          '<div class="precio_albanileria_con">Precio albañilería con solera: <span>' +
            data.precio_albanileria_con +
            "€</span></div>"
        );
        $("#precio_albanileria_con").val(data.precio_albanileria_con);
      } else {
        $(".txt_resumen.precio .precio_desmontaje_interior").after(
          '<div class="precio_albanileria_con"></div>'
        );
        $("#precio_albanileria_con").val(0);
      }

      if (data.precio_albanileria_sin > 0) {
        $(".txt_resumen.precio .precio_albanileria_con").after(
          '<div class="precio_albanileria_sin">Precio albañilería sin solera: <span>' +
            data.precio_albanileria_sin +
            "€</span></div>"
        );
        $("#precio_albanileria_sin").val(data.precio_albanileria_sin);
      } else {
        $(".txt_resumen.precio .precio_albanileria_con").after(
          '<div class="precio_albanileria_sin"></div>'
        );
        $("#precio_albanileria_sin").val(0);
      }

      if (data.precio_extras_1 > 0) {
        $(".txt_resumen.precio .precio_albanileria_sin").after(
          '<div class="precio_extras_1">Rematar por dentro: <span>' +
            data.precio_extras_1 +
            "€</span></div>"
        );
        $("#precio_extras_1").val(data.precio_extras_1);
      } else {
        $(".txt_resumen.precio .precio_albanileria_sin").after(
          '<div class="precio_extras_1"></div>'
        );
        $("#precio_extras_1").val(0);
      }

      if (data.precio_extras_2 > 0) {
        $(".txt_resumen.precio .precio_extras_1").after(
          '<div class="precio_extras_2">Rematar interior sin frente: <span>' +
            data.precio_extras_2 +
            "€</span></div>"
        );
        $("#precio_extras_2").val(data.precio_extras_2);
      } else {
        $(".txt_resumen.precio .precio_extras_1").after(
          '<div class="precio_extras_2"></div>'
        );
        $("#precio_extras_2").val(0);
      }
      if (data.precio_extras_3 > 0) {
        $(".txt_resumen.precio .precio_extras_2").after(
          '<div class="precio_extras_3">Instalación fijo: <span>' +
            data.precio_extras_3 +
            "€</span></div>"
        );
        $("#precio_extras_3").val(data.precio_extras_3);
      } else {
        $(".txt_resumen.precio .precio_extras_2").after(
          '<div class="precio_extras_3"></div>'
        );
        $("#precio_extras_3").val(0);
      }
      if (data.precio_extras_4 > 0) {
        $(".txt_resumen.precio .precio_extras_3").after(
          '<div class="precio_extras_4"> Instalación costado: <span>' +
            data.precio_extras_4 +
            "€</span></div>"
        );
        $("#precio_extras_4").val(data.precio_extras_4);
      } else {
        $(".txt_resumen.precio .precio_extras_3").after(
          '<div class="precio_extras_4"></div>'
        );
        $("#precio_extras_4").val(0);
      }
      if (data.precio_extras_5 > 0) {
        $(".txt_resumen.precio .precio_extras_4").after(
          '<div class="precio_extras_5">Módulo con viga: <span>' +
            data.precio_extras_5 +
            "€</span></div>"
        );
        $("#precio_extras_5").val(data.precio_extras_5);
      } else {
        $(".txt_resumen.precio .precio_extras_4").after(
          '<div class="precio_extras_5"></div>'
        );
        $("#precio_extras_5").val(0);
      }
      if (data.precio_extras_6 > 0) {
        $(".txt_resumen.precio .precio_extras_5").after(
          '<div class="precio_extras_6">Interior con chaflán: <span>' +
            data.precio_extras_6 +
            "€</span></div>"
        );
        $("#precio_extras_6").val(data.precio_extras_6);
      } else {
        $(".txt_resumen.precio .precio_extras_5").after(
          '<div class="precio_extras_6"></div>'
        );
        $("#precio_extras_6").val(0);
      }
      if (data.precio_extras_7 > 0) {
        $(".txt_resumen.precio .precio_extras_6").after(
          '<div class="precio_extras_7">Frente con chaflán: <span>' +
            data.precio_extras_7 +
            "€</span></div>"
        );
        $("#precio_extras_7").val(data.precio_extras_7);
      } else {
        $(".txt_resumen.precio .precio_extras_6").after(
          '<div class="precio_extras_7"></div>'
        );
        $("#precio_extras_7").val(0);
      }
      if (data.precio_extras_8 > 0) {
        $(".txt_resumen.precio .precio_extras_7").after(
          '<div class="precio_extras_8">Registro: <span>' +
            data.precio_extras_8 +
            "€</span></div>"
        );
        $("#precio_extras_8").val(data.precio_extras_8);
      } else {
        $(".txt_resumen.precio .precio_extras_7").after(
          '<div class="precio_extras_8"></div>'
        );
        $("#precio_extras_8").val(0);
      }
      if (data.precio_extras_9 > 0) {
        $(".txt_resumen.precio .precio_extras_8").after(
          '<div class="precio_extras_9">Desplazar punto de luz: <span>' +
            data.precio_extras_9 +
            "€</span></div>"
        );
        $("#precio_extras_9").val(data.precio_extras_9);
      } else {
        $(".txt_resumen.precio .precio_extras_8").after(
          '<div class="precio_extras_9"></div>'
        );
        $("#precio_extras_9").val(0);
      }
      if (data.precio_extras_10 > 0) {
        $(".txt_resumen.precio .precio_extras_9").after(
          '<div class="precio_extras_10">Módulo forrado: <span>' +
            data.precio_extras_10 +
            "€</span></div>"
        );
        $("#precio_extras_10").val(data.precio_extras_10);
      } else {
        $(".txt_resumen.precio .precio_extras_9").after(
          '<div class="precio_extras_10"></div>'
        );
        $("#precio_extras_10").val(0);
      }
      if (data.precio_extras_11 > 0) {
        $(".txt_resumen.precio .precio_extras_10").after(
          '<div class="precio_extras_11">Módulo diamante: <span>' +
            data.precio_extras_11 +
            "€</span></div>"
        );
        $("#precio_extras_11").val(data.precio_extras_11);
      } else {
        $(".txt_resumen.precio .precio_extras_10").after(
          '<div class="precio_extras_11"></div>'
        );
        $("#precio_extras_11").val(0);
      }
      if (data.precio_extras_12 > 0) {
        $(".txt_resumen.precio .precio_extras_11").after(
          '<div class="precio_extras_12">Incremento por balda extra: <span>' +
            data.precio_extras_12 +
            "€</span></div>"
        );
        $("#precio_extras_12").val(data.precio_extras_12);
      } else {
        $(".txt_resumen.precio .precio_extras_11").after(
          '<div class="precio_extras_12"></div>'
        );
        $("#precio_extras_12").val(0);
      }
      if (data.precio_extras_13 > 0) {
        $(".txt_resumen.precio .precio_extras_12").after(
          '<div class="precio_extras_13">Incremento por módulo partido: <span>' +
            data.precio_extras_13 +
            "€</span></div>"
        );
        $("#precio_extras_13").val(data.precio_extras_13);
      } else {
        $(".txt_resumen.precio .precio_extras_12").after(
          '<div class="precio_extras_13"></div>'
        );
        $("#precio_extras_13").val(0);
      }

      if (data.precio_albanileria_sencilla > 0) {
        $(".txt_resumen.precio .precio_extras_13").after(
          '<div class="precio_albanileria_sencilla">Albañilería sencilla: <span>' +
            data.precio_albanileria_sencilla +
            "€</span></div>"
        );
        $("#precio_albanileria_sencilla").val(data.precio_albanileria_sencilla);
      } else {
        $(".txt_resumen.precio .precio_extras_13").after(
          '<div class="precio_albanileria_sencilla"></div>'
        );
        $("#precio_albanileria_sencilla").val(0);
      }
      if (data.precio_albanileria_tirar_tabique > 0) {
        $(".txt_resumen.precio .precio_albanileria_sencilla").after(
          '<div class="precio_albanileria_tirar_tabique">Tirar tabique o maletero: <span>' +
            data.precio_albanileria_tirar_tabique +
            "€</span></div>"
        );
        $("#precio_albanileria_tirar_tabique").val(
          data.precio_albanileria_tirar_tabique
        );
      } else {
        $(".txt_resumen.precio .precio_albanileria_sencilla").after(
          '<div class="precio_albanileria_tirar_tabique"></div>'
        );
        $("#precio_albanileria_tirar_tabique").val(0);
      }
      if (data.precio_albanileria_quitar_solera > 0) {
        $(".txt_resumen.precio .precio_albanileria_tirar_tabique").after(
          '<div class="precio_albanileria_quitar_solera">Quitar solera: <span>' +
            data.precio_albanileria_quitar_solera +
            "€</span></div>"
        );
        $("#precio_albanileria_quitar_solera").val(
          data.precio_albanileria_quitar_solera
        );
      } else {
        $(".txt_resumen.precio .precio_albanileria_tirar_tabique").after(
          '<div class="precio_albanileria_quitar_solera"></div>'
        );
        $("#precio_albanileria_quitar_solera").val(0);
      }
      if (data.precio_albanileria_mover_enchufe > 0) {
        $(".txt_resumen.precio .precio_albanileria_quitar_solera").after(
          '<div class="precio_albanileria_mover_enchufe">Mover enchufe o interruptor: <span>' +
            data.precio_albanileria_mover_enchufe +
            "€</span></div>"
        );
        $("#precio_albanileria_mover_enchufe").val(
          data.precio_albanileria_mover_enchufe
        );
      } else {
        $(".txt_resumen.precio .precio_albanileria_quitar_solera").after(
          '<div class="precio_albanileria_mover_enchufe"></div>'
        );
        $("#precio_albanileria_mover_enchufe").val(0);
      }
      if (data.precio_albanileria_costado_pladur > 0) {
        $(".txt_resumen.precio .precio_albanileria_mover_enchufe").after(
          '<div class="precio_albanileria_costado_pladur">Hacer costado de pladur: <span>' +
            data.precio_albanileria_costado_pladur +
            "€</span></div>"
        );
        $("#precio_albanileria_costado_pladur").val(
          data.precio_albanileria_costado_pladur
        );
      } else {
        $(".txt_resumen.precio .precio_albanileria_mover_enchufe").after(
          '<div class="precio_albanileria_costado_pladur"></div>'
        );
        $("#precio_albanileria_costado_pladur").val(0);
      }

      if (data.precio_km_medicion > 0) {
        $(".txt_resumen.precio .precio_albanileria_costado_pladur").after(
          '<div class="km_medicion">Precio km medición: <span>' +
            data.precio_km_medicion +
            "€</span></div>"
        );
        $("#precio_km_medicion").val(data.precio_km_medicion);
      } else {
        $(".txt_resumen.precio .precio_albanileria_costado_pladur").after(
          '<div class="km_medicion"></div>'
        );
        $("#precio_km_medicion").val(0);
      }

      if (data.precio_km_montaje > 0) {
        $(".txt_resumen.precio .km_medicion").after(
          '<div class="km_montaje">Precio km montaje: <span>' +
            data.precio_km_montaje +
            "€</span></div>"
        );
        $("#precio_km_montaje").val(data.precio_km_montaje);
      } else {
        $(".txt_resumen.precio .km_medicion").after(
          '<div class="km_montaje"></div>'
        );
        $("#precio_km_montaje").val(0);
      }

      $(".txt_resumen.precio .km_montaje").after(
        '<div class="iva">I.V.A.: <span>' + data.iva + "€</span></div>"
      );
      $("#iva").val(data.iva);

      $(".txt_resumen.precio .iva").after(
        '<div class="precio_total"><b>PRECIO TOTAL: <span>' +
          (parseFloat(data.total) + parseFloat(data.iva)).toFixed(2) +
          "€</span></b></div>"
      );
      $("#precio_total").val(
        (parseFloat(data.total) + parseFloat(data.iva)).toFixed(2)
      );

      $(".referencia_proyecto").html(
        data.referencia + "<br />" + data.referencia_2
      );
    },
    "json"
  );
}