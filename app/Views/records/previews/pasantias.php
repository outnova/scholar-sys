<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, portador de la cédula de identidad Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de <span class="rdata-wul"><?= esc(get_setting('principal_position')) ?></span> de este prestigioso plantel educativo.
</p>
<p class="paragraph">
    Por medio de la presente, hago constar que el (la) ciudadano (a): <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, 
    portador(a) de identidad <span class="record-data"><?= formatCedulaEx($data['cedula'], $data['nacionalidad'] ?? '') ?></span>, se encuentra realizando <span class="record-data">pasantías</span>, en el Nivel de <span class="record-data">educación <?= esc($data['nivel']) ?></span> 
    con fecha de inicio desde <span class="record-data"><?= formatLargeDate($data['fecha-inicio']) ?></span> hasta el <span class="record-data"><?= formatLargeDate($data['fecha-fin']) ?></span>.
</p>
<p class="paragraph">
    Constancia que se expide a petición de la parte interesada en <?= esc(get_setting('school_shortcity')) ?>; a los <?= literalRecordDate(true) ?>.
</p>
<p class="paragraph">
    Sin más a que referir, se despide,
</p>