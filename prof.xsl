<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:template match="/">
    <th>Professional Experience</th>
        <td>
        <xsl:apply-templates select="profexp/exp" />
        </td>
</xsl:template>

<xsl:template match="exp">
    <p>
        <strong><xsl:value-of select="title" /></strong><br />
        <xsl:value-of select="org" /><br />
        <xsl:apply-templates select="duties" />
    </p>
</xsl:template>

<xsl:template match="duties">
    <ul>
    <xsl:for-each select="duty">
        <li><xsl:value-of select="." /></li>
    </xsl:for-each>
    </ul>
</xsl:template>
</xsl:stylesheet>
