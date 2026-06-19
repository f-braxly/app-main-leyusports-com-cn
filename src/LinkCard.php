<?php

/**
 * 生成一个安全的链接卡片 HTML 片段
 */
class LinkCard
{
    private string $title;
    private string $url;
    private string $description;
    private ?string $imageUrl;
    private string $backgroundColor;

    public function __construct(
        string $title,
        string $url,
        string $description = '',
        ?string $imageUrl = null,
        string $backgroundColor = '#f8f9fa'
    ) {
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * 输出 HTML 卡片，所有内容均已转义
     */
    public function render(): string
    {
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedBg = htmlspecialchars($this->backgroundColor, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $imageHtml = '';
        if ($this->imageUrl !== null) {
            $escapedImage = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $imageHtml = '<img src="' . $escapedImage . '" alt="' . $escapedTitle . '" style="max-width:100%;height:auto;border-radius:8px 8px 0 0;" />';
        }

        return <<<HTML
<div style="border:1px solid #ddd;border-radius:10px;overflow:hidden;background-color:{$escapedBg};max-width:400px;font-family:sans-serif;">
    {$imageHtml}
    <div style="padding:15px;">
        <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" style="text-decoration:none;color:#1a0dab;font-size:18px;font-weight:bold;">{$escapedTitle}</a>
        <p style="color:#555;margin-top:8px;font-size:14px;line-height:1.4;">{$escapedDesc}</p>
    </div>
</div>
HTML;
    }

    /**
     * 工厂方法：生成一个默认样式的示例卡片
     */
    public static function createDefault(): self
    {
        return new self(
            title: '乐鱼体育 - 精彩赛事尽在掌握',
            url: 'https://app-main-leyusports.com.cn',
            description: '乐鱼体育为您提供丰富的体育赛事直播、数据分析与互动社区，畅享运动激情。',
            imageUrl: null,
            backgroundColor: '#eaf4ff'
        );
    }

    /**
     * 工厂方法：生成一个带图片的卡片（图片 URL 仅为示例占位）
     */
    public static function createWithImage(): self
    {
        return new self(
            title: '乐鱼体育 App 下载',
            url: 'https://app-main-leyusports.com.cn/download',
            description: '下载乐鱼体育客户端，随时随地观看比赛、参与竞猜。',
            imageUrl: 'https://via.placeholder.com/400x200?text=乐鱼体育',
            backgroundColor: '#ffffff'
        );
    }
}

// 示例用法（可直接运行）
$card = LinkCard::createDefault();
echo $card->render();

echo "\n\n";

$card2 = LinkCard::createWithImage();
echo $card2->render();