<div
    class="gis-thematic-switcher mb-3"
>

    <button
        class="btn btn-danger gis-theme-btn active"
        data-urusan="pendidikan"
    >
        Pendidikan
    </button>

    <button
        class="btn btn-primary gis-theme-btn"
        data-urusan="kesehatan"
    >
        Kesehatan
    </button>

    <button
        class="btn btn-success gis-theme-btn"
        data-urusan="pupr"
    >
        PUPR
    </button>

</div>
<div class="gis-analysis-wrapper">
    <!-- BREADCRUMB -->
    <div class="gis-breadcrumb">
        <button id="backToNational" style="display:none;">
            ← Indonesia
        </button>
        <span id="gisTitle">
            Peta Nasional RPJMD
        </span>
    </div>

    <!-- SVG -->
    <div id="svgMapContainer"></div>
    <div id="gisLegend" class="gis-legend-card"></div>
    <div id="gisTooltip" class="gis-tooltip"></div>
</div>
