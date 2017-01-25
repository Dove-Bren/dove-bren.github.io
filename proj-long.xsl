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
        <div class="minorlabel"><xsl:value-of select="classification" /></div>
        <a href="project-page.php?page={urltag}" class="silent">
        <h4 class="subheader"><xsl:value-of select="title" /></h4>
        </a>
        <div style="min-height: 1em; text-align: center;"><a href="{url}"><xsl:value-of select="url" /></a></div>
        <div class="showpic"><a href="project-page.php?page={urltag}">
        <!-- <a href="screenshots.php?prefix={title}"> -->
        <xsl:choose>
          <xsl:when test="img">
            <img src="{img}" alt="{tagline}" class="showpic" />
          </xsl:when>
          <xsl:otherwise>
            No Image Available
          </xsl:otherwise>
        </a></div>
        <xsl:apply-templates select="tags" />
        <xsl:apply-templates select="longdesc" />
        <center><a href="project-page.php?page={urltag}" class="silent">
        <button class="more">See More</button>
        </a></center>
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
