<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0" >
    <xsl:output method="xml" version="1.0" omit-xml-declaration="yes" indent="yes" media-type="text/html"/>

    <xsl:template match="/">
        <xsl:element name="h1">
            <xsl:value-of select="rss/channel/title" />
        </xsl:element>
        <xsl:element name="h3">
            <xsl:value-of select="rss/channel/description" />
        </xsl:element>
        <xsl:element name="h4">
            <xsl:value-of select="rss/channel/item[1]/title" />
        </xsl:element>
        <xsl:element name="p">
            <xsl:value-of select="rss/channel/item[1]/description" />
        </xsl:element>
        <xsl:element name="h4">
            <xsl:value-of select="rss/channel/item[2]/title" />
        </xsl:element>
        <xsl:element name="p">
            <xsl:value-of select="rss/channel/item[2]/description" />
        </xsl:element>
        <xsl:element name="h4">
            <xsl:value-of select="rss/channel/item[3]/title" />
        </xsl:element>
        <xsl:element name="p">
            <xsl:value-of select="rss/channel/item[3]/description" />
        </xsl:element>
    </xsl:template>


</xsl:stylesheet>