<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, portador de la cédula de identidad Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de Director (e) de la <span class="record-data"><?= esc(get_setting('school_name')) ?></span>, ubicada en la <?= esc(get_setting('school_address')) ?> de esta ciudad de <?= esc(get_setting('school_longcity')) ?>.
</p>
<p class="paragraph">
    Por medio de la presente, hago constar que el (la) ciudadano(a): <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, 
    portador(a) de la cédula de identidad N° <span class="record-data"><?= formatCedula($data['cedula']) ?></span> cumple funciones en esta institución educativa como: <span class="record-data"><?= esc($data['cargo_funciones']) ?></span>, código de cargo: <span class="record-data"><?= esc($data['codigo_cargo']) ?></span>,
    dependencia: <span class="record-data"><?= esc($data['dependencia']) ?></span>, código de dependencia: <span class="record-data"><?= esc($data['codigo_dependencia']) ?></span>, en el nivel de: <span class="record-data">educación <?= esc($data['nivel']) ?></span> en nuestra institución desde el <span class="record-data"><?= formatDate($data['fecha_ingreso']) ?></span>
    hasta la presente fecha; devengando una remuneración mensual de <span class="money">Bs.</span> <span class="record-data"><?= esc($data['sueldo_mensual']) ?></span> de acuerdo al recibo de pago emanado por la Oficina de Gestión Humana del Ministerio del Poder Popular para la Educación.
</p>
<p class="paragraph">
    Constancia que se emite en <?= esc(get_setting('school_shortcity')) ?> a los <?= literalRecordDate(true) ?>.
</p>
<p class="paragraph">
    Sin más a que referir, se despide;
</p>