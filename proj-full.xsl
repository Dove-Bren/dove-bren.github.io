<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="proj">
  <div>
    <p>
    <h4 class="subheader" style="margin-bottom: 3px;"><xsl:value-of select="tagline" /></h4>
    <xsl:choose>
      <xsl:when test="url">
        <center><a href="{url}"><xsl:value-of select="url" /></a></center>
      </xsl:when>
    </xsl:choose>
    <xsl:apply-templates select="tags" />
    </p>


    <xsl:apply-templates select="fulldesc" />
    <!--
    <center><img src="{img}" alt="no picture available" class="showpic" /></center>
    -->

    <!-- <xsl:apply-templates select="screenshots" /> -->

  </div>
</xsl:template>

<xsl:template match="tags">
    <div>
    <ul class="taglist">
    Tags:
    <xsl:for-each select="tag">
        <li class="tag"><xsl:value-of select="." /></li>
    </xsl:for-each>
    </ul>
    </div>
</xsl:template>

<xsl:template match="fulldesc">
    <xsl:for-each select="*">
      <xsl:apply-templates select="." />
    </xsl:for-each>
    <!-- <xsl:apply-templates select="./*" /> -->
</xsl:template>



<xsl:template match="p">
    <p class="desc">
      <xsl:value-of select="." />
    </p>
</xsl:template>

<xsl:template match="list">
    <ul>
    <xsl:for-each select="li">
      <li><xsl:value-of select="." /></li>
    </xsl:for-each>
    </ul>
</xsl:template>

<xsl:template match="subhead">
    <h3 class="subheader"><xsl:value-of select="." /></h3>
    <hr class="subrule" />
</xsl:template>

<xsl:template match="screenshots">
    <div class="screenshotpeek">
       <!--
       <xsl:value-of select='php:function
        ("spawnLightbox", "{../title}", "4")' /> 
       -->
    </div>
</xsl:template>

</xsl:stylesheet>
