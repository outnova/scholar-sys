<p class="paragraph">
    Quien suscribe <b><i><u><?= esc(get_setting('principal_name')) ?></u></i></b>, portador de la cédula de identidad Nº <b><i><u><?= esc(get_setting('principal_ci')) ?></u></i></b>, en mi condición de Director (e) de la <b><i><u><?= esc(get_setting('school_name')) ?></u></i></b>, ubicada en la <?= esc(get_setting('school_address')) ?> de esta ciudad de <?= esc(get_setting('school_longcity')) ?>.
</p>
<p class="paragraph">
    Por medio de la presente, hago constar que el (la) ciudadano(a): <b><i><u><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></u></i></b>, 
    portador(a) de la cédula de identidad N° <b><i><u><?= esc($data['cedula']) ?></u></i></b> cumple funciones en esta institución educativa como: <b><i><u><?= esc($data['cargo_funciones']) ?></u></i></b>, código de cargo: <b><i><u><?= esc($data['codigo_cargo']) ?></u></i></b>,
    dependencia: <b><i><u><?= esc($data['dependencia']) ?></u></i></b>, código de dependencia: <b><i><u><?= esc($data['codigo_dependencia']) ?></u></i></b>, en el nivel de: <b><i><u><?= esc($data['nivel']) ?></u></i></b> en nuestra institución desde el <b><i><u><?= esc($data['fecha_ingreso']) ?></u></i></b>
    hasta la presente fecha; devengando una remuneración mensual de <b><i><u>Bs. <?= esc($data['sueldo_mensual']) ?></u></i></b> de acuerdo al recibdo de pago emanado por la Oficina de Gestión Humana del Ministerio del Poder Popular para la Educación.
</p>
<p class="paragraph">
    Constancia que se emite en <?= esc(get_setting('school_shortcity')) ?> a los 13 días.
</p>
<p class="paragraph">
    Sin más a que referir, se despide;
</p>