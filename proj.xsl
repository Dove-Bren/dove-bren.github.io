<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
    <th>Projects</th>
        <td>
        <xsl:apply-templates select="projects/proj" />
        </td>
</xsl:template>

<xsl:template match="proj">
    <p>
        <strong><xsl:value-of select="title" /></strong><br />
        <a href="{url}"><xsl:value-of select="url" /></a>
        <xsl:apply-templates select="descs" />
    </p>
</xsl:template>

<xsl:template match="descs">
    <ul>
    <xsl:for-each select="desc">
        <li><xsl:value-of select="." /></li>
    </xsl:for-each>
    </ul>
</xsl:template>
</xsl:stylesheet>
