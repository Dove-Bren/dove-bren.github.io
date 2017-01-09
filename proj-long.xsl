<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
    <!-- <table class="wrapcontainer datatable"> -->
    <xsl:for-each select="projects/proj">
        <!-- <td class="wrappable datacell"><xsl:apply-templates select="." /></td> -->
        <div class="wrappable datacell"><xsl:apply-templates select="." /></div>
    </xsl:for-each>
    <!-- </table> -->
</xsl:template>

<xsl:template match="proj">
  <div>
        <a href="project-page.php?page={urltag}" class="silent">
        <h4 class="subheader"><xsl:value-of select="title" /></h4><br />
        </a>
        <a href="{url}"><xsl:value-of select="url" /></a><br />
        <center><img src="{img}" alt="No Picture Available" class="showpic" /></center>
        <xsl:apply-templates select="tags" />
        <xsl:apply-templates select="longdesc" />
        <!--
        <center><
        -->
  </div>
</xsl:template>

<xsl:template match="tags">
    <div>
    <ul class="taglist">
    <xsl:for-each select="tag">
        <li class="tag"><xsl:value-of select="." /></li>
    </xsl:for-each>
    </ul>
    </div>
</xsl:template>

<xsl:template match="longdesc">
    <p class="desc">
    <xsl:value-of select="." />
    </p>
</xsl:template>
</xsl:stylesheet>
